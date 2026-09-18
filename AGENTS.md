# AGENTS.md — exim-billing

## What is this

Legacy PHP billing/stock management system for HNK Exim (Laos). Serves at `https://hnk.exim.la`. Originally PHP 5.6, migrated to PHP 7.4 in Docker.

## Sync workflow (how code moves)

```
apis.com.la (UAT)  →  D:\exim-billing (local)  →  GitHub  →  DO droplet (production)
  /var/www/html/exim/                                                           hnk.exim.la
```

1. Customer updates code on apis.com.la (`/var/www/html/exim/`)
2. Download changed files to local `D:\exim-billing`
3. **Grep for hardcoded `apis.com.la` URLs** and fix them (dev team frequently leaves old server URLs)
4. Commit & push to GitHub (`bounthongv/exim-billing`, branch `main`)
5. GitHub Actions auto-deploys to DO droplet

## Critical constraints

- **PHP 7.4 only.** PHP 5.6 can't connect to MySQL 8. PHP 8.x crashes on `null * int` and `@$var[...]` patterns used throughout.
- **`dblink.php` is gitignored** and contains DB credentials. Never commit it. It's restored on the server by `/root/fix-dblink.sh` after each deploy.
- **`dblink.php` also runs `extract($_GET)` / `extract($_POST)`** — this means every GET/POST param becomes a local variable. Files include `dblink.php` and use these variables directly.

## Deploy flow (auto)

1. Push to `main` → GitHub Actions SSHs into DO droplet
2. Runs: `git pull` → `bash /root/fix-dblink.sh` → `docker compose up --build -d`
3. Container: `php-app` (PHP 7.4 + Apache, port 80)
4. Droplet: `139.59.221.28`, DB host from container: `172.17.0.1`

## Project structure

- Root: login page (`index.php`), `check_login.php`, `logout.php`, `dblink.php`
- `admin/`: main app — all CRUD, reports, invoices, barcode features
- `admin/init.php`: session guard + includes `dblink.php`. Every admin page starts with this.
- `admin/header.php`: nav bar, reads menus from DB (`menu_header`, `menu_list`, `menu_user` tables)
- `admin/composer.json`: only dependency is `phpoffice/phpspreadsheet` (for Excel exports)
- `laos/`: Lao font files (NotoSerifLao, Saysettha)
- `css/`, `admin/css/`: Bootstrap 3 + custom styles

## Code conventions

- **No framework.** Raw PHP + mysqli + jQuery + Bootstrap 3.
- SQL queries are inline in PHP files (no ORM, no query builder).
- Variables from `extract()` in `dblink.php` — don't look for variable declarations, they come from POST/GET.
- `@` error suppression used liberally (`@$row[...]`).
- Lao language UI throughout. English labels appear in some DB column names and form fields.
- File naming: `add_*.php` (forms), `insert_*.php` (handlers), `fetch_*.php` (AJAX data), `cart_*.php` (cart views), `print_*.php` (printable reports).

## SSH / server access

**apis.com.la (UAT source server):**
- Host: `apis.com.la`, User: `apis`, Password: `apis@#2024`
- Source path: `/var/www/html/exim/`
- User has key-based auth set up from local PC (passwordless)

**DO droplet (production):**
- IP: `139.59.221.28`, User: `root`
- SSH: `ssh -i ~/.ssh/id_ed25519_deploy root@139.59.221.28`
- Key: `~/.ssh/id_ed25519_deploy` (on local PC, comment: `github-actions-deploy`)
- phpMyAdmin: `https://hnk.exim.la/phpmyadmin` (admin / Sql_admin@#2024)
- Full details: `docs/1a-hnk-droplet.md`

## Database

- Name: `exim_stock`, user: `admin`, password: `Sql_admin@#2024`, charset: `utf8`
- Host from container: `172.17.0.1`, from droplet: `localhost`
- Auth: `mysql_native_password` (NOT `caching_sha2_password`)
- Key tables: `users`, `stocks`, `menu_header`, `menu_list`, `menu_user`, `tb_cta`, `products`, `customers`, `suppliers`

## Gotchas

- No test suite exists. No linter, no typecheck, no CI checks beyond deploy.
- `.gitignore` excludes `*.jpg`, `*.png`, `*.sql`, `*.sql.gz`, `dblink.php`.
- `dblink0.php` is a copy of `dblink.php` (also gitignored in practice).
- Timezone: `dblink.php` sets `Asia/Vientiane`, `admin/init.php` sets `Asia/Bangkok` (they differ by 1 hour).
- After syncing from `apis.com.la`, grep for hardcoded `apis.com.la` URLs — dev team sometimes leaves old server URLs in the code.
