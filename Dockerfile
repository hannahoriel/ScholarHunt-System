FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json .npmrc ./
RUN npm install --ignore-scripts --no-audit --no-fund

COPY . .
RUN npm run build

FROM php:8.5-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev libsqlite3-dev libzip-dev unzip \
    && docker-php-ext-install mbstring pdo_mysql pdo_sqlite zip \
    && a2enmod rewrite \
    && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

COPY --from=frontend /app/public/build ./public/build

ENV APP_ENV=production \
    APP_DEBUG=false

EXPOSE 80

CMD ["apache2-foreground"]
