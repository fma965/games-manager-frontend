FROM serversideup/php:8.5-fpm-nginx-alpine

LABEL maintainer="Fma965" \
    description="nginx php-8 games-manager-frontend"

ENV NGINX_WEBROOT='/app/web'

ARG APP_VERSION=dev

# UID/GID for www-data, matching the Kubernetes pod securityContext (runAsUser/runAsGroup)
ARG USER_ID=1000
ARG GROUP_ID=1000

# Build steps need root; the container itself runs as www-data
USER root

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

COPY /app/ /app/
RUN echo "$APP_VERSION" > /app/VERSION
COPY vhost-common.conf /etc/nginx/server-opts.d/10-general.conf

RUN composer install -d /app

USER www-data

EXPOSE 8080
