# exim-billing — DO Droplet Deployment Overview

**Last updated:** 2026-07-21

## Infrastructure

| Item | Detail |
|------|--------|
| Droplet | `marketplace-gd-2vcpu-8gb-sgp1` (ID: 584434880) |
| IP | 139.59.221.28 (reserved/floating) |
| Region | Singapore (SGP1) |
| Cost | $68/month |
| OS | Ubuntu 22.04 |
| Web proxy | Nginx (host) → Docker (container) |
| Database | MySQL 8.0.46 (native on host, accessed from Docker via `172.17.0.1`) |
| DB name | `exim_stock` |
| DB user | `admin` / `Sql_admin@#2024` (auth: `mysql_native_password`, charset: `utf8mb3`) |
| SSL | Self-signed cert + Cloudflare "Full" (not "Full Strict") |
| Cloudflare | Orange cloud ☁️ enabled for both subdomains |

---

## Sites

### 1. `https://hnk.exim.la` — exim-billing ✅ LIVE

| Item | Detail |
|------|--------|
| App | Exim billing/stock management |
| Source | apis.com.la `/var/www/html/exim/` (PHP 5.6 original) |
| Local folder | `D:\exim-billing` |
| GitHub | `bounthongv/exim-billing` |
| Docker container | `php-app` (PHP 7.4, port 80 → host port 80) |
| Config file | `dblink.php` (`.gitignore` → restored by `/root/fix-dblink.sh`) |
| Deploy workflow | Git push → GitHub Actions → ssh → git pull → fix-dblink.sh → docker compose up |
| Login | `admin` / `niken20` |
| phpMyAdmin | `https://hnk.exim.la/phpmyadmin` |

### 2. `https://shopping.exim.la` — shopping/invoice ✅ LIVE

| Item | Detail |
|------|--------|
| App | Invoice/shopping management |
| Source | apis.com.la `/var/www/html/invoice/` (PHP 5.6, 19 files, 212KB) |
| Local folder | `D:\shopping-exim` |
| GitHub | `bounthongv/shopping-exim` |
| Docker container | `shopping-app` (PHP 7.4, port 80 → host port **8081**) |
| Config file | `config.php` (`.gitignore` → restored by `/root/fix-shopping-config.sh`) |
| Deploy workflow | Git push → GitHub Actions → ssh → git pull → fix-shopping-config.sh → docker compose up |
| Login | `admin` / `niken20` (same DB) |
| Direct access | `http://139.59.221.28:8081` (for testing without DNS) |

---

## Architecture

```
Cloudflare (SSL: Full)
  ├── hnk.exim.la ──────────→ Nginx (443) ──→ localhost:80  ──→ php-app (exim-billing)
  └── shopping.exim.la ─────→ Nginx (443) ──→ localhost:8081 ──→ shopping-app
                                    │
                                    └── phpmyadmin (PHP 8.1 FPM, at /phpmyadmin path)
```

**Docker containers (both PHP 7.4):**

```
$ docker ps
NAMES          IMAGE               STATUS          PORTS
shopping-app   shopping-exim-web   Up 4 days       0.0.0.0:8081→80/tcp
php-app        exim-billing-web    Up 4 days       0.0.0.0:80→80/tcp
```

**Nginx configs enabled:**

```
/etc/nginx/sites-enabled/
  hnk-exim       → /etc/nginx/sites-available/hnk-exim
  shopping-exim  → /etc/nginx/sites-available/shopping-exim
```

**Config restore scripts (on DO droplet, root):**

- `/root/fix-dblink.sh` — recreates `dblink.php` after `git pull` for exim-billing
- `/root/fix-shopping-config.sh` — recreates `config.php` after `git pull` for shopping-exim

---

## GitHub Secrets Required

Both repos need these 3 secrets in Settings → Secrets → Actions:

| Secret | Value |
|--------|-------|
| `VPS_HOST` | `139.59.221.28` |
| `VPS_USER` | `root` |
| `VPS_SSH_KEY` | Private key from DO console: `cat /root/.ssh/id_ed25519_deploy` |

- `bounthongv/exim-billing` — secrets already set
- `bounthongv/shopping-exim` — secrets need to be added (as of last session)

---

## Workflow (sync from apis.com.la)

1. Customer updates code on **apis.com.la** (dev server)
2. Download changed files from `/var/www/html/exim/` (exim-billing) or `/var/www/html/invoice/` (shopping)
3. Commit to local repo and push to GitHub
4. GitHub Actions auto-deploys to DO droplet
5. `config.php` / `dblink.php` are **not** in Git — restored by fix scripts post-pull

> **Key rule:** Fix the environment (PHP config, Nginx config, MySQL config), not the code. The local repo should be a clean mirror of apis.com.la.

---

## PHP Version Constraint

Only **PHP 7.4** works with this legacy codebase:

| PHP Version | Problem |
|-------------|---------|
| 5.6 | Won't connect to MySQL 8 (charset negotiation fails) |
| **7.4** | ✅ Works — lenient with `@$var[...]`, `null * int` patterns |
| 8.x | Breaks on TypeError (`null * int` crashes pages) |

---

## Current Status (2026-07-21)

| Site | HTTP Check | DNS | Status |
|------|-----------|-----|--------|
| `https://hnk.exim.la` | ✅ 200 OK (Cloudflare) | ✅ 104.26.x.x (proxied) | **LIVE** |
| `https://shopping.exim.la` | ✅ 200 OK (Cloudflare) | ✅ 104.26.x.x (proxied) | **LIVE** |
| `http://139.59.221.28:8081` | ✅ 200 OK (direct) | N/A | **Accessible** |

Both sites are fully operational and accessible via their subdomains through Cloudflare.
