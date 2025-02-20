FROM webdevops/php-nginx:8.3-alpine

LABEL maintainer="Fma965" \
    description="nginx php-8 games-manager-frontend"

ENV WEB_DOCUMENT_ROOT='/app/web'

COPY /app/ /app/
COPY vhost-common.conf /opt/docker/etc/nginx/vhost.common.d/10-general.conf

RUN composer install -d /app