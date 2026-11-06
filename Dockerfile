FROM dunglas/frankenphp:1-php8.4-alpine AS base

WORKDIR /app
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && install-php-extensions mbstring

FROM base AS dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache unzip
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

FROM base AS runtime
COPY --from=dependencies /app/vendor ./vendor
COPY Caddyfile ./
COPY about.php contact.php index.php projects.php send-message.php ./
COPY assets ./assets
COPY css ./css
COPY includes ./includes
COPY js ./js

ENV PORT=80
CMD ["frankenphp", "run", "--config", "/app/Caddyfile"]
