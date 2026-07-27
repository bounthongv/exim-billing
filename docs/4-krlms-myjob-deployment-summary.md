# KRLMS & MYJOB — Deployment Summary

## Droplet Details

| Item | Detail |
|------|--------|
| **Droplet IP** | 159.89.209.151 (same as lms.ijobs.la) |
| **Nginx** | Already installed, reverse-proxying both new sites |

## GitHub Repos

| Site | Repo | CI/CD |
|------|------|-------|
| **krlms.ijobs.la** | [bounthongv/krlms-lms](https://github.com/bounthongv/krlms-lms) | Deploy on push to master |
| **myjob.ijobs.la** | [bounthongv/myjob-lms](https://github.com/bounthongv/myjob-lms) | Deploy on push to master |

## Docker Setup

| App | Directory | Port | Container |
|-----|-----------|------|-----------|
| krlms | `/opt/krlms/` | 8083 | `krlms-app` |
| myjob | `/opt/myjob/` | 8084 | `myjob-app` |

### Docker files:
- `Dockerfile` — `php:8.3-apache` with `pdo_mysql`, `a2enmod rewrite`
- `custom.ini` — `display_errors = Off`, upload limits
- `docker-compose.krlms.yml` / `docker-compose.myjob.yml`

## Nginx Config

- **krlms.ijobs.la**: port 80 → 301 → port 443 SSL → proxy_pass localhost:8083
- **myjob.ijobs.la**: port 80 → 301 → port 443 SSL → proxy_pass localhost:8084
|- SSL: **Let's Encrypt** (certbot) — covers all 3 domains (SAN: lms, krlms, myjob)
|- Auto-renewal via systemd timer + cron fallback
|- Set Cloudflare to **Full (Strict)** for origin certificate validation

## Database

| Database | User | Password |
|----------|------|----------|
| `korea_db` | `korea` | `K0rea%2024` |
| `myjob_db` | `myjob` | `Myjob%2024` |

Both databases use `utf8mb4_general_ci`.

## Deploy Workflow

1. Push source code to `master` branch on GitHub
2. GitHub Actions runs `deploy.yml`:
   - SSH into droplet
   - `git pull` in `/opt/krlms/` or `/opt/myjob/`
   - Restore `connect.php` from backup (`/root/connect-krlms.php` or `/root/connect-myjob.php`)
   - `docker compose up --build -d`

## Source Code

Both repos currently only have the Docker infrastructure scaffold. The actual PHP source code (from `korea.apis.com.la` and `myjob.apis.com.la`) needs to be pushed to `master`. Once pushed, the CI/CD pipeline will auto-deploy.

### Steps to add source:

```bash
# For krlms (source: korea.apis.com.la or apis.com.la/korea)
cd /opt/krlms
git pull origin master
# Add/PHP source files here
cp /root/connect-krlms.php connect.php
git add -A
git commit -m "Add KRLMS source code"
git push

# For myjob (source: myjob.apis.com.la)
cd /opt/myjob
git pull origin master
# Add PHP source files here
cp /root/connect-myjob.php connect.php
git add -A
git commit -m "Add MYJOB source code"
git push
```

## Domains & DNS

Both domains use Cloudflare proxies (orange cloud):

| Domain | Target |
|--------|--------|
| `krlms.ijobs.la` | A-record → 159.89.209.151 |
| `myjob.ijobs.la` | A-record → 159.89.209.151 |
