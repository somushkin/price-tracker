FROM php:8.1-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y cron

COPY cronjob /etc/cron.d/my-cron

RUN chmod 0644 /etc/cron.d/my-cron && \
    crontab /etc/cron.d/my-cron

RUN mkdir /var/log/cron
