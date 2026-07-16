FROM php:8.2-apache
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli
# Custom PHP config - matches apis.com.la production settings (hide warnings, log errors)
RUN { \
        echo 'display_errors = Off'; \
        echo 'log_errors = On'; \
        echo 'error_log = /var/log/php_errors.log'; \
        echo 'date.timezone = Asia/Vientiane'; \
    } > /usr/local/etc/php/conf.d/custom.ini
WORKDIR /var/www/html
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
EXPOSE 80
