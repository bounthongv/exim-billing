DigitalOcean Droplet for hnk.exim.la:

| Item                           | Value                                             |
|--------------------------------|---------------------------------------------------|
| Droplet IP (Reserved/Floating) | 139.59.221.28                                     |
| Droplet ID                     | 584434880 (marketplace-gd-2vcpu-8gb-sgp1)         |
| Region                         | sgp1 (Singapore)                                  |
| OS                             | Ubuntu 22.04                                      |
| SSH User                       | root                                              |
| SSH Key                        | ~/.ssh/id_ed25519_deploy (private key on your PC) |
| Deploy Key Comment             | github-actions-deploy                             |

MySQL (on host, accessed from Docker via 172.17.0.1):
| Item        | Value                                                |
|-------------|------------------------------------------------------|
| Host        | 172.17.0.1 (from container) / localhost (on droplet) |
| User        | admin                                                |
| Password    | Sql_admin@#2024                                      |
| Database    | exim_stock                                           |
| Charset     | utf8mb3 (critical for PHP 5.6/7.4 compatibility)     |
| Auth Plugin | mysql_native_password (NOT caching_sha2_password)    |

GitHub Actions Secrets (in bounthongv/exim-billing repo):
- VPS_HOST = 139.59.221.28
- VPS_USER = root
- VPS_SSH_KEY = contents of ~/.ssh/id_ed25519_deploy (private key)

Access:
bash
From your PC (git-bash):
ssh -i ~/.ssh/id_ed25519_deploy root@139.59.221.28

Or via DO Console: https://cloud.digitalocean.com/droplets/584434880


phpMyAdmin: https://hnk.exim.la/phpmyadmin (user admin / pass Sql_admin@#2024)

The deploy key (id_ed25519_deploy) was manually added to the droplet's ~/.ssh/authorized_keys — it's not in your DO account's SSH key store, so new droplets won't get it automatically.
