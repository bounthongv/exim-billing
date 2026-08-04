# iJob LMS — Latest Sync Session Summary

> **Scope:** Most recent working session on the **job** project (ijobs-lms).
> **Date:** 2026-08-03 (14:09 local)
> **Sync source:** `job.apis.com.la` → `/var/www/html/job/` (PHP 8.3, PDO `connect.php`)
> **Local folder:** `D:\job`
> **Git repo:** `bounthongv/ijobs-lms` (branch `master`)
> **Deploy target:** DigitalOcean — `/opt/job`, container `job-app`, → `https://lms.ijobs.la`

---

## What the session did

1. **Downloaded** `/var/www/html/job/` (job.apis.com.la) into the local folder `D:\job`.
2. **Uploaded to GitHub** — committed and pushed the synced changes to `bounthongv/ijobs-lms` (master).
3. **Verified the auto-deploy** at DigitalOcean — GitHub Actions picked up the push and redeployed the container.

## Commit pushed (latest)

```
63029ce  2026-08-03 14:09  Sync updates from job.apis.com.la
                           + fix hardcoded URLs in check.php/logout.php + ignore del/
```

Files in the commit:

| File | Change |
|------|--------|
| `.gitignore` | Ignore `file/korea/del/` (the new delete-photo scripts live under this folder). |
| `file/korea/form/data_entry_edit.php` | Passport field no longer `required`. |
| `file/korea/form/vacancy_edit.php` | Renamed header to "Candidate Edit"; added the action bar (Cancel / Verify / Save) **before** the card; moved `</form>` to close outside the card; added "delete photo" buttons for `profile` and `id_profile`. |
| `file/korea/js/vacancy.js` | Added `del_profile` and `del_id_profile` handlers: Swal confirm → AJAX POST to `../del/del_profile.php` / `../del/del_id_profile.php` → reload on `"success"`. |

## Pending / not yet committed (working tree in D:\job)

The following edits are still uncommitted — likely the next sync round:

- `file/check.php` and `file/logout.php` — redirect `header("Location:...")` pointed back at `https://job.apis.com.la/`.
  > Note: commit 63029ce's message says "fix hardcoded URLs in check.php/logout.php", but the working tree currently carries `job.apis.com.la` hardcoded back in — either reverted by a fresh download from apis.com.la or the pre-fix state. Verify before the next push.
- `file/korea/form/data_entry_add.php`, `data_entry_edit.php`, `file/korea/form/vacancy_edit.php` — data-entry form tweaks.
- `file/korea/js/data_entry.js` — added the same delete-photo handlers (`del_profile`, `del_file_form`) as vacancy.js.

## Deploy pipeline (how the autodeploy was verified)

`.github/workflows/deploy.yml` (triggers on push to `master`/`main`):
1. `appleboy/ssh-action` → SSH to DO droplet (`VPS_HOST` secret).
2. `git fetch origin` + `git reset --hard origin/master` in `/opt/job`.
3. Run `/root/fix-job-connect.sh` (restores `connect.php` after the hard reset — same pattern as the other apps).
4. `docker compose -f docker-compose.job.yml up --build -d`.
5. `mkdir -p file/korea/uploads` + `chown -R 33:33` so `www-data` can write uploads.

## Conventions (same family as the other apps)
- `connect.php` is **not** committed; the droplet restores it after every deploy.
- Always **grep for hardcoded `apis.com.la` URLs** in PHP after each sync and fix them (the dev team keeps leaving the old server URLs — that's exactly what this session's check.php/logout.php change was about).
- Local repo is kept as a **clean mirror** of apis.com.la; fix the environment (config/nginx/php), not the source.

---

*Filed 2026-08-03 from the git history and working tree of `D:\job`.*