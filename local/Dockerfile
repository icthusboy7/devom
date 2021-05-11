FROM php:7.4.11-fpm-alpine3.12

WORKDIR /app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev rabbitmq-c rabbitmq-c-dev postgresql-libs postgresql-dev openssh-client \
    && pecl install amqp-1.9.4 \
    && pecl install xdebug-2.9.8 \
    && docker-php-ext-install -j$(nproc) \
        opcache \
        intl \
        pgsql \
        pdo_pgsql \
    && docker-php-ext-enable \
        amqp \
        opcache

COPY local/php/ /usr/local/etc/php/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

