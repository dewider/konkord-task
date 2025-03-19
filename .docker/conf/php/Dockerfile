FROM php:8.2-fpm

RUN apt-get update \
    && apt-get --no-install-recommends install -y \
    curl \
    wget \
    ssh \
    host \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libwebp-dev \
    && pecl install mcrypt-1.0.6 \
    && pecl install memcache-8.0 \
    && docker-php-ext-install exif \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-enable memcache \
    && docker-php-ext-enable exif \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip opcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN apt-get --no-install-recommends install -y cron \
    && echo "* * * * * www-data cd /var/www && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab \
    && crontab /etc/crontab

RUN chmod gu+rw /var/run \
    && chmod gu+s /usr/sbin/cron

WORKDIR /var/www

RUN cd /var/www/laravel \
    php artisan migrate

CMD ["/start.sh"]