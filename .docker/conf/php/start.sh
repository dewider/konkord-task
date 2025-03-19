#!/bin/bash

eval "$(grep ^COMPOSE_PROJECT_NAME= /var/www/.docker/.env)"

cat /etc/hosts_default > /etc/hosts
echo `host php | grep -Po '[0-9]+.[0-9]+.[0-9]+.[0-9]+'` `hostname` >> /etc/hosts
echo `host nginx | grep -Po '[0-9]+.[0-9]+.[0-9]+.[0-9]+'` `echo $COMPOSE_PROJECT_NAME.local` >> /etc/hosts

crontab /etc/crontab
cron

cd /var/www/laravel
php artisan queue:work &

php-fpm