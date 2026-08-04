# Web App Mapping — apis.com.la ⇄ Local ⇄ GitHub ⇄ DO

**Every app follows the same sync flow:** download changed files from `apis.com.la`
→ drop into the local folder → commit & push to GitHub → CI/CD auto-deploys to DO.

**Sources on apis.com.la** are served under subdomains of `apis.com.la`
(e.g. `job.apis.com.la` → `/var/www/html/job/` on the server).

---

## The 5 apps

| apis.com.la web | Root / Location | Local directory | Git repo | DO domain |
|-----------------|-----------------|-----------------|----------|-----------|
| `job.apis.com.la` | `/var/www/html/job/` | `D:\job` | `bounthongv/ijobs-lms` (master) | `lms.ijobs.la` |
| `korea.apis.com.la` | `/var/www/html/korea/` | `D:\krlms` | `bounthongv/krlms-lms` (master) | `krlms.ijobs.la` |
| `myjob.apis.com.la` | `/var/www/html/myjob/` | `D:\myjob` | `bounthongv/myjob-lms` (master) | `myjob.ijobs.la` |
| `exim.apis.com.la` | `/var/www/html/exim/` | `D:\exim-billing` | `bounthongv/exim-billing` (main) | `hnk.exim.la` |
| `invoice.apis.com.la` | `/var/www/html/invoice/` | `D:\shopping-exim` | `bounthongv/shopping-exim` (master) | `shopping.exim.la` |

---

## Details per app

### 1. LMS (iJob) — `https://lms.ijobs.la`
- **apis.com.la source:** `job.apis.com.la` → `/var/www/html/job/` (PHP 8.3, PDO `connect.php`)
- **Local folder:** `D:\job`
- **Git repo:** `bounthongv/ijobs-lms` (branch `master`)
- **DO domain:** `lms.ijobs.la`
- **Droplet:** 159.89.209.151 · container `job-app` (PHP 8.3, port 8082) · DB `job`

### 2. KRLMS — **https://krlms.ijobs.la**
- **Domain.com.la source:** `korea.apis.com.la` → `/var/www/html/korea/` (PDO `connect.php`)
- **Local folder:** `D:\krlms`
- **Git repo:** `bounthongv/krlms-lms` (branch `master`)
- **DO domain:** `krlms.ijobs.la`
- **Droplet:** 159.89.209.151 · container `krlms-app` (PHP 8.3, port 8083) · DB `korea_db`

### 3. MYJOB — `https://myjob.ijobs.la`
- **Domain.com.la source:** `myjob.apis.com.la` → `/var/www/html/myjob/` (PDO `connect.php`)
- **Local folder:** `D:\myjob`
- **Git repo:** `bounthongv/myjob-lms` (branch `master`)
- **DO domain:** `myjob.ijobs.la`
- **Droplet:** 159.89.209.151 · container `myjob-app` (PHP 8.3, port 8084) · DB `myjob_db`

### 4. HNK EXIM — `https://hnk.exim.la`
- **Domain.com.la source:** `exim.apis.com.la` → `/var/www/html/exim/` (PHP 5.6, mysqli `dblink.php` → restored by `/root/fix-dblink.sh`)
- **Local folder:** `D:\exim-billing`
- **Git repo:** `bounthongv/exim-billing` (branch `main`)
- **DO domain:** `hnk.exim.la`
- **Droplet:** 139.59.221.28 · container `php-app` (PHP 7.4, port 80) · DB `exim_stock`

### 5. SHOPPING — `https://shopping.exim.la`
- **Domain.com.la source:** `invoice.apis.com.la` → `/var/www/html/invoice/` (PHP 5.6, 19 files, 212KB; `config.php` restored by `/root/fix-shopping-config.sh`)
- **Local folder:** `D:\shopping-exim`
- **Git repo:** `bounthongv/shopping-exim` (branch `master`)
- **DO domain:** `shopping.exim.la`
- **Droplet:** 139.59.221.28 · container `shopping-app` (PHP 7.4, port 8081) · DB `exim_stock`

---

## Sync workflow (per app)

1. Customer updates code on the **apis.com.la** subdomain.
2. Download the **changed files only** to the matching local folder.
3. Commit & push to the GitHub repo (see table above).
4. GitHub Actions auto-deploys to the DO droplet (runs `git pull` + restore-config script + `docker compose up --build`).
5. After every sync, **grep for hardcoded `apis.com.la` URLs** in PHP source and fix them before deploying (dev team frequently leaves old server URLs).

> **Tip:** always confirm the app's config file (`connect.php`/`dblink.php`/`config.php`) is NOT committed (it's in `.gitignore`), and that its restore script exists on the droplet — otherwise the deploy will use the wrong DB credentials.