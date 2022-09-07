FROM php:7.4.14-fpm

# Установка основных модулей PHP
RUN apt update && apt install -y \
        libmcrypt-dev \
        mcrypt \
        libxpm-dev \
        libvpx-dev \
        libldap2-dev \
        unixodbc-dev \
        libpq-dev \
        libicu-dev \
        zlib1g-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev \
        libwebp-dev\
        libjpeg62-turbo-dev\
        libfreetype6-dev\
        sendmail

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install mcrypt-1.0.4 && docker-php-ext-enable mcrypt

# Install required extensions
RUN install-php-extensions ldap
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath

RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini

RUN set -eux; \
	docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp;\
    docker-php-ext-install -j "$(nproc)" \
    		gd

RUN pecl install sqlsrv pdo_sqlsrv

RUN docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr

RUN install-php-extensions pdo_odbc

ENV ACCEPT_EULA=Y
# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install apt-utils libxml2-dev gnupg apt-transport-https \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install MS ODBC Driver for SQL Server
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-install soap