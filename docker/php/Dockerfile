FROM php:8.4.27-fpm

# Системные библиотеки для расширений + очистка apt в том же слое
RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev \
        zlib1g-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql intl zip bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Временная мера против CVE-2026-115560 (ещё не исправлена в релизах)
RUN echo "session.upload_progress.enabled = 0" > /usr/local/etc/php/conf.d/zz-security.ini