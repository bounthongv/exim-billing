# Job (iJob) Droplet — Deployment Overview

**Last updated:** 2026-07-21

## Droplet Details

| Item | Detail |
|------|--------|
| **DO ID** | 586352303 |
| **Name** | `ubuntu-s-2vcpu-4gb-120gb-intel-sgp1` |
| **Public IP** | 167.71.194.103 |
| **Reserved IP** | **159.89.209.151** (use this for DNS) |
| **Region** | sgp1 (Singapore) |
| **Specs** | 2 vCPU / 4 GB RAM / 120 GB SSD |
| **OS** | Ubuntu 24.04 LTS |
| **Cost** | $32/month |
| **SSH key** | Deploy key (`id_ed25519_deploy`) added via DO console |

## Status (2026-07-21)

| Component | Status |
|-----------|--------|
| Reserved IP | ✅ **159.89.209.151** (use for DNS) |
| SSH access | ✅ Working (via deploy key) |
| Docker | ✅ **29.6.2** installed, running |
| Nginx | ✅ **1.24.0** installed, proxying port 80 → 8082 |
| MySQL | ✅ **8.0.46** installed, `job` DB created, `admin`@`%` user |
| MySQL bind | ✅ Bound to `0.0.0.0` (Docker gateway accessible) |
| Nginx config | ✅ `lms.ijobs.la` reverse proxy to `127.0.0.1:8082` |
| Restore script | ✅ `/root/fix-job-connect.sh` restores `connect.php` |
| Docker container | ✅ `job-app` running (PHP 8.3.32, port 8082) |
| Website test | ✅ HTTP 200 on localhost:80 (via Nginx) |
| GitHub repo | ✅ `bounthongv/ijobs-lms` |
| Local code | ✅ `D:\job` (849 files, 12 MB) |
| Dockerfile | ✅ `php:8.3-apache` + `pdo_mysql` |
| SSL (HTTPS) | ✅ Self-signed cert, port 443, Cloudflare Full mode |
| CI/CD | ✅ GitHub Actions (`deploy.yml`) — auto-deploys on push |
| Site URL | ✅ **https://lms.ijobs.la** — HTTP 200, redirects HTTP→HTTPS |

## Source Code

| Item | Detail |
|------|--------|
| Source server | apis.com.la (Ubuntu, Apache) |
| Source path | `/var/www/html/job/` |
| PHP on source | **PHP 8.3** via mod_php (no FPM handler) |
| Files | 849 files, 12 MB total |
| DB config file | `connect.php` (PDO, not mysqli) |
| Database | `job` — 4.05 MB, 11 tables |
| Auth | `admin` / `Sql_admin@#2024` (same DB user as exim-billing) |
| Local folder | `D:\job` |
| GitHub repo | `bounthongv/ijobs-lms` |

## Database Tables

| Table | Rows | Status |
|-------|------|--------|
| `agency_korea` | 3 | ✅ Imported |
| `data_entry` | 4 | ✅ Imported |
| `data_entry_korea` | 3,169 | ✅ Imported |
| `district` | 147 | ✅ Imported |
| `district_korea` | 10 | ✅ Imported |
| `employer` | 9 | ✅ Imported |
| `labor_korea` | 2,789 | ✅ Imported |
| `province` | 18 | ✅ Imported |
| `province_korea` | 0 | ✅ Imported |
| `users` | 0 | ✅ Imported |
| `village` | 0 | ✅ Imported |

## Notes

- Uses **PDO** (`connect.php`) not mysqli — Dockerfile needs `pdo_mysql` extension
- Same `.gitignore` + restore-script pattern as hnk/shopping-exim
- Login credentials same as exim-billing: `admin` / `niken20` (to verify)
- Will follow same architecture: Nginx (host:443) → Docker (PHP 8.3 Apache) → MySQL (host)
