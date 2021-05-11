FROM php:7.4.11-fpm-alpine3.12

ARG SSH_PRIVATE_KEY

WORKDIR /app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev openssh-client \
    && docker-php-ext-install -j$(nproc) \
        opcache \
        intl \
    && docker-php-ext-enable \
        opcache

RUN mkdir /root/.ssh/ \
    && echo "${SSH_PRIVATE_KEY}" > /root/.ssh/id_rsa \
    && eval $(ssh-agent -s) \
    && chmod 600 /root/.ssh/id_rsa \
    && ssh-add ~/.ssh/id_rsa \
    && touch /root/.ssh/known_hosts \
    && ssh-keyscan bitbucket.org > /root/.ssh/known_hosts

RUN echo "Host bitbucket.org\n\tStrictHostKeyChecking no\n" >> /root/.ssh/config

COPY . ./

RUN mkdir -p /app/var/cache
RUN mkdir -p /app/var/logs
RUN chown -R www-data /app/var/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

ARG SYMFONY_SKIP_REGISTRATION=1
RUN composer install --optimize-autoloader --no-progress && composer clear-cache
