FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --fix-missing   \
    nginx\
    git \
    zip  \
    libzip-dev  \
    unzip  \
    libfreetype6-dev  \
    libjpeg62-turbo-dev  \
    libxslt-dev  \
    libpng-dev  \
    libc-client-dev  \
    libkrb5-dev  \
    libldap2-dev \
    libpq-dev \
    postgresql-client \
    postgresql \
    wget \
    nano \
    locate

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Dev tools >
# --- Xdebug
RUN pecl install xdebug-3.2.1 && docker-php-ext-enable xdebug
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini.dis

# --- Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# --- Bash aliases
COPY .bashrc /root/.bashrc
# Dev tools <

# PHP configuration >
COPY ./php/conf.d/php.dev.ini /usr/local/etc/php/conf.d/docker-php-ext.ini
# PHP configuration <

RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY ./docker-entrypoint /docker-entrypoint

EXPOSE 80
ENTRYPOINT [ "/bin/bash" ,"/docker-entrypoint"]
CMD [ "php-fpm" ]
