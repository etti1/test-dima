FROM php:8.2-fpm

ENV DEBIAN_FRONTEND noninteractive
ARG TZ=UTC

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
        curl \
        libpq-dev \
        git \
        zip \
        unzip; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-install pdo_pgsql;

RUN apt-get update && apt-get install -y libicu-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN curl -S https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo 'ping localhost &' > /bootstrap.sh
RUN echo 'sleep infinity' >> /bootstrap.sh
RUN chmod +x /bootstrap.sh

workdir /dima