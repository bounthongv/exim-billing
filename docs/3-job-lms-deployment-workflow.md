# iJob LMS (lms.ijobs.la) — Full Deployment Workflow

**Date:** 2026-07-21
**Author:** Deployment log

This document records the complete workflow for deploying `lms.ijobs.la` (iJob LMS) on a new DigitalOcean droplet, following the same pattern as `hnk.exim.la` and `shopping.exim.la`.

---

## 1. Droplet Provisioning

| Item | Value |
|------|-------|
| Droplet ID | 586352303 |
| Name | `ubuntu-s-2vcpu-4gb-120gb-intel-sgp1` |
| Origin IP | `167.71.194.103` (ephemeral — changes on restart) |
| Reserved IP | **`159.89.209.151`** (use this for DNS — stable) |
| Region | sgp1 (Singapore) |
| Specs | 2 vCPU / 4 GB RAM / 120 GB SSD |
| OS | Ubuntu 24.04 LTS |
| Cost | $32/month |
| SSH key | `id_ed25519_deploy` (comment: `github-actions-deploy`) added via DO Console |

### Reserved IP

Created via DigitalOcean API (browser login blocked by CAPTCHA):

```bash
curl -X POST -H "Content-Type: application/json" \
  -H "Authorization: Bearer dop_v1_..." \
  -d '{"region":"sgp1"}' \
  "https://api.digitalocean.com/v2/reserved_ips"

# Assign to droplet
curl -X POST -H "Content-Type: application/json" \
  -H "Authorization: Bearer dop_v1_..." \
  -d '{"type":"assign","droplet_id":586352303}' \
  "https://api.digitalocean.com/v2/reserved_ips/159.89.209.151/actions"
```

---

## 2. Software Stack Installation

SSH into the droplet and install:

```bash
ssh -i ~/.ssh/id_ed25519_deploy root@159.89.209.151
```

### Docker

```bash
curl -fsSL https://get.docker.com | sh
docker --version   # 29.6.2
```

### Nginx

```bash
apt update && apt install -y nginx
nginx -v           # 1.24.0
```

### MySQL

```bash
apt install -y mysql-server
mysql --version    # 8.0.46
```

### Secure MySQL

```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '[REDACTED]';
CREATE USER 'admin'@'%' IDENTIFIED WITH mysql_native_password BY '[REDACTED]';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

Bind MySQL to `0.0.0.0` in `/etc/mysql/mysql.conf.d/mysqld.cnf` so Docker containers can reach it via `172.17.0.1`:

```
bind-address = 0.0.0.0
```

---

## 3. SSH & GitHub Deploy Key Setup

### The `id_ed25519_deploy` key

This single SSH key serves **two purposes**:

1. **SSH access to droplets** — public key (`id_ed25519_deploy.pub`) added to `~/.ssh/authorized_keys` on each droplet (via DO Console or manual)
2. **GitHub repo access** — public key added as a **deploy key** on the GitHub repo with **Allow write access**

### GitHub Deploy Key

Added at: https://github.com/bounthongv/ijobs-lms/settings/keys

| Field | Value |
|-------|-------|
| Title | `github-actions-deploy` |
| Key | Contents of `~/.ssh/id_ed25519_deploy.pub` |
| Allow write access | ✅ **Checked** (needed for `git pull` on the droplet) |

### Droplet SSH Config

On the droplet, create `~/.ssh/config` so `git pull` uses the right key:

```
Host github.com
    HostName github.com
    IdentityFile ~/.ssh/id_ed25519_deploy
    StrictHostKeyChecking no
```

Also add GitHub to `known_hosts`:

```bash
ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts 2>/dev/null
```

The private key (`id_ed25519_deploy`) is **also copied** to the droplet at `~/.ssh/id_ed25519_deploy` so the droplet itself can pull from GitHub during auto-deploy.

---

## 4. GitHub Repository Setup

| Item | Value |
|------|-------|
| Repo | `bounthongv/ijobs-lms` |
| Branch | `master` |
| Local path | `D:\job` |
| Source | `apis.com.la:/var/www/html/job/` (849 files, ~12 MB) |

### Scaffolding files created locally

| File | Purpose |
|------|---------|
| `Dockerfile` | `FROM php:8.3-apache`, `a2enmod rewrite`, `docker-php-ext-install pdo pdo_mysql` |
| `docker-compose.job.yml` | Service `web`, container `job-app`, port `8082:80`, volume `./:/var/www/html` |
| `.gitignore` | Excludes `connect.php`, `composer.*`, `*.sql`, `*.log` |
| `connect.php` | PDO connection to `172.17.0.1` (Docker gateway), user `admin` |
| `.github/workflows/deploy.yml` | GitHub Actions CI/CD pipeline |

### GitHub Secrets

Set at: https://github.com/bounthongv/ijobs-lms/settings/secrets/actions

| Secret | Value |
|--------|-------|
| `VPS_HOST` | `159.89.209.151` |
| `VPS_USER` | `root` |
| `VPS_SSH_KEY` | Full private key content from `~/.ssh/id_ed25519_deploy` (including BEGIN/END lines) |

### Deploy Workflow (`.github/workflows/deploy.yml`)

Triggers on push to `master`:

```yaml
name: Deploy to DigitalOcean

on:
  push:
    branches: [ master, main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Deploy via SSH
        uses: appleboy/ssh-action@v1.2.1
        with:
          host: ${{ secrets.VPS_HOST }}
          username: ${{ secrets.VPS_USER }}
          key: ${{ secrets.VPS_SSH_KEY }}
          port: 22
          script_stop: true
          script: |
            cd /opt/job
            git pull origin master
            bash /root/fix-job-connect.sh
            docker compose -f docker-compose.job.yml up --build -d
```

**Flow:** Push → GitHub Actions → appleboy/ssh-action → SSH to droplet → `git pull` → restore `connect.php` → Docker compose rebuild & restart

---

## 5. Database Migration

Dump from source (`apis.com.la`):

```bash
mysqldump -u [user] -p job > /tmp/job-dump.sql
```

SCP to new droplet:

```bash
scp /tmp/job-dump.sql root@159.89.209.151:/tmp/job-dump.sql
```

Import:

```bash
mysql -u admin -p job < /tmp/job-dump.sql
```

| Table | Rows |
|-------|------|
| `agency_korea` | 3 |
| `data_entry` | 4 |
| `data_entry_korea` | 3,169 |
| `district` | 147 |
| `district_korea` | 10 |
| `employer` | 9 |
| `labor_korea` | 2,789 |
| `province` | 18 |
| `province_korea` | 0 |
| `users` | 0 |
| `village` | 0 |

---

## 6. Config Restore Script

On the droplet at `/root/fix-job-connect.sh`:

```bash
#!/bin/bash
# Restore connect.php after git pull (file is in .gitignore)
cp /root/connect.php /opt/job/connect.php
chown www-data:www-data /opt/job/connect.php
chmod 644 /opt/job/connect.php
echo "connect.php restored"
```

The master copy of `connect.php` lives at `/root/connect.php` on the droplet (copied manually once during initial setup).

---

## 7. Nginx Configuration

### File: `/etc/nginx/sites-available/lms.ijobs.la`

```nginx
# HTTP → HTTPS redirect
server {
    listen 80;
    server_name lms.ijobs.la;
    return 301 https://$host$request_uri;
}

# HTTPS (port 443) with self-signed cert
server {
    listen 443 ssl http2;
    server_name lms.ijobs.la;

    ssl_certificate /etc/ssl/certs/lms-ijobs.crt;
    ssl_certificate_key /etc/ssl/private/lms-ijobs.key;

    location / {
        proxy_pass http://localhost:8082;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }

    location ~* \.(js|css|jpg|jpeg|png|gif|ico)$ {
        add_header Cache-Control "no-store, no-cache, must-revalidate, max-age=0";
        add_header Pragma "no-cache";
        expires -1;
        proxy_pass http://localhost:8082;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
    }
}
```

Enable the site:

```bash
ln -s /etc/nginx/sites-available/lms.ijobs.la /etc/nginx/sites-enabled/
nginx -t && nginx -s reload
```

---

## 8. SSL Certificate (Self-Signed)

Cloudflare SSL/TLS mode must be set to **Full** (accepts self-signed origin certs).

Generate on the droplet:

```bash
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 \
    -keyout /etc/ssl/private/lms-ijobs.key \
    -out /etc/ssl/certs/lms-ijobs.crt \
    -subj "/CN=lms.ijobs.la" \
    -addext "subjectAltName=DNS:lms.ijobs.la"

chmod 600 /etc/ssl/private/lms-ijobs.key
```

### Cloudflare DNS

| Type | Name | Value | Proxy |
|------|------|-------|-------|
| A | `lms` | `159.89.209.151` | ☁️ Proxied (orange cloud) |

### Cloudflare SSL/TLS

| Setting | Value |
|---------|-------|
| SSL/TLS encryption mode | **Full** (not Full strict) |

---

## 9. First Deploy (Manual)

Before the auto-deploy pipeline can work, the repo must be cloned on the droplet:

```bash
mkdir -p /opt/job
cd /opt/job
git clone git@github.com:bounthongv/ijobs-lms.git /opt/job
bash /root/fix-job-connect.sh
docker compose -f docker-compose.job.yml up --build -d
```

---

## 10. Architecture Diagram

```
Internet → Cloudflare (orange cloud)
    ↓
Reserved IP (159.89.209.151):443
    ↓
Host Nginx (port 443, self-signed cert, proxies to 8082)
    ↓
Docker container job-app (port 8082 → 80 Apache PHP 8.3)
    ↓
Host MySQL (172.17.0.1:3306)
```

---

## 11. Key Decisions

| Question | Decision | Reason |
|----------|----------|--------|
| PHP version | **8.3** | All projects on apis.com.la run `mod_php8.3` |
| Docker base image | `php:8.3-apache` | Matches source environment, includes Apache |
| DB config | **PDO** (not mysqli) | Source code uses `$conn = new PDO(...)` |
| Config persistence | Restore script pattern | `connect.php` in `.gitignore`, restored by `/root/fix-job-connect.sh` |
| Droplet path | `/opt/job` | Clean directory, separate from system files |
| Deploy action | `appleboy/ssh-action@v1.2.1` | Standard SSH deploy with error handling (`script_stop: true`) |
| SSL cert | **Self-signed** | Cloudflare handles client-facing HTTPS; origin only needs any cert for "Full" mode |

---

## 12. Troubleshooting Notes

### GitHub Actions "SSH step failed" (quick failure in 2-3 seconds)

| Cause | Fix |
|-------|-----|
| Secrets not set | Add `VPS_HOST`, `VPS_USER`, `VPS_SSH_KEY` in repo settings |
| SSH key format wrong | Must include full key with BEGIN/END lines and proper newlines |
| Deploy key not added to GitHub | Add public key as deploy key with write access |
| `appleboy/ssh-action` version | Use `@v1.2.1` (not `@v1.0.3`) |
| Missing `port: 22` or `script_stop: true` | Add both parameters to the action step |

### Git pull fails on droplet ("Permission denied")

| Cause | Fix |
|-------|-----|
| No private key on droplet | Copy `id_ed25519_deploy` to `~/.ssh/id_ed25519_deploy` |
| No SSH config | Create `~/.ssh/config` pointing to `IdentityFile ~/.ssh/id_ed25519_deploy` |
| GitHub not in known_hosts | Run `ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts` |

### Cloudflare 521 error

| Cause | Fix |
|-------|-----|
| Port 443 not listening on droplet | Install SSL cert + configure Nginx for HTTPS |
| Cloudflare SSL mode wrong | Set to **Full** (not Flexible, not Full strict) |
