FROM node:22-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .

ENV NODE_OPTIONS="--max-old-space-size=512"
RUN npm run build

FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    mysql-client

RUN docker-php-ext-install pdo pdo_mysql bcmath gd Simplexml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

COPY --from=frontend-builder /app/public/build ./public/build
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

EXPOSE 8080
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]