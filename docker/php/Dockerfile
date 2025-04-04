FROM php:7.4.28-fpm

# Установка необходимых системных библиотек
RUN apt update && apt install -y \
        libicu-dev \
        zlib1g-dev \
        libzip-dev

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка необходимых расширений PHP
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath

# Очистка кэша apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*