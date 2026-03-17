# Backend
FROM composer:2.2.7 as build

COPY src/ /app

WORKDIR /app

RUN composer install \
    --no-dev \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Frontend
FROM node:15.12.0 as frontend

COPY src/package.json src/package-lock.json src/webpack.mix.js src/webpack.config.js src/tailwind.config.js /app/
COPY src/public/ /app/public/
COPY src/lang/ /app/lang/
COPY src/resources/ /app/resources/

WORKDIR /app
RUN npm ci && npm run prod

# Final image
FROM laravel:latest

COPY --from=build /app /app
COPY --from=frontend /app/public/js/ /app/public/js/
COPY --from=frontend /app/public/css/ /app/public/css/
COPY --from=frontend /app/public/mix-manifest.json /app/public/mix-manifest.json
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini-production /usr/local/etc/php/php.ini
COPY docker/entrypoint.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

ENTRYPOINT [ "/usr/local/bin/start" ]
