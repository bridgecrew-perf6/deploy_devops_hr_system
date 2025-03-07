FROM php:7.4-apache

# To give all permissions to project
# RUN chmod -R 777 .

COPY . /var/www/html/
COPY .htaccess /var/www/html/.htaccess
RUN mkdir -p bootstrap/cache/ && chmod -R 777 bootstrap/cache/
RUN chmod -R 777 /var/www/html/
# RUN ["cp",  "/var/www/html/site/htaccess", "/var/www/html/site/.htaccess"]
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
#RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

RUN docker-php-ext-enable pdo_mysql
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

#RUN a2enmod rewrite
RUN service apache2 restart
# RUN cd /var/www/html && composer install

WORKDIR /var/www/html
# CMD php artisan optimize
# CMD php artisan cache:clear
# CMD php artisan config:clear
# CMD php artisan route:clear
# CMD php artisan view:clear
CMD php artisan serve --host=0.0.0.0 --port=80 
# CMD php artisan migrate
#RUN chown -R 777 www-data:www-data /var/www/html/

# install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# allow readable, writable and executable by all users
#RUN chmod 777 /var/www/html/ 
EXPOSE 80
# CMD ["apache2-foreground"]
# - chmod -R 755 wp-content
# - chown -R apache:apache wp-content
# - service httpd start
# - chkconfig httpd on
