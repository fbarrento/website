FROM serversideup/php:8.4-fpm-nginx-bookworm AS base

# Switch to root so we can do root things
USER root

# Platform requirements
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y openssh-client git git-lfs jq software-properties-common

# Cleanup
RUN apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install PHP extensions
RUN install-php-extensions intl

# Drop back to our unprivileged user
USER www-data

######## START DEVELOPMENT ########
FROM base AS development

USER root
ARG NODE_VERSION=22

# Development requirements
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm

# Cleanup
RUN apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Save the build arguments as a variable
ARG USER_ID=9999
ARG GROUP_ID=9999

# Change the UID and GID of www-data while and the file permissions for NGINX
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

# Drop back to our unprivileged user
USER www-data

######## START PRODUCTION ########
FROM composer:2 AS build_composer

WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist

FROM node:22 AS build_frontend
WORKDIR /var/www/html
COPY --from=build_composer /var/www/html /var/www/html

RUN npm ci
RUN npm run build
RUN rm -rf node_modules

FROM base AS production
USER root

COPY --chown=www-data:www-data --from=build_frontend /var/www/html /var/www/html

# Drop back to our unprivileged user
USER www-data
