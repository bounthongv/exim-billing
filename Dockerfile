FROM php:7.4-apache
# Debian bullseye is EOL -> deb.debian.org 404s; point apt at the archive mirror before installing ghostscript
RUN sed -i "s|deb.debian.org|archive.debian.org|g" /etc/apt/sources.list && apt-get update && apt-get install -y ghostscript && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN { \
        echo "display_errors = Off"; \
        echo "log_errors = On"; \
        echo "error_log = /var/log/php_errors.log"; \
        echo "date.timezone = Asia/Vientiane"; \
        echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT"; \
        echo "upload_max_filesize = 20M"; \
        echo "post_max_size = 21M"; \
        echo "memory_limit = 128M"; \
    } > /usr/local/etc/php/conf.d/custom.ini
WORKDIR /var/www/html
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
EXPOSE 80
