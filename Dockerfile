FROM php:7.4-apache
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql mysqli
# Custom PHP config - matches apis.com.la (which uses PHP 5.6 with FPM)
# We use PHP 7.4 because PHP 5.6 + MySQL 8 has charset negotiation issues
# PHP 7.4 is more lenient with @-suppression and null arithmetic than PHP 8.x
RUN { \
        echo 'display_errors = Off'; \
        echo 'log_errors = On'; \
        echo 'error_log = /var/log/php_errors.log'; \
        echo 'date.timezone = Asia/Vientiane'; \
        echo 'error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT'; \
    } > /usr/local/etc/php/conf.d/custom.ini
WORKDIR /var/www/html
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
EXPOSE 80
