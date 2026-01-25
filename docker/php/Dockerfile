FROM php:8.4-fpm-alpine

# ===============================
# 1. Устанавливаем системные зависимости
# ===============================
RUN apk add --no-cache \
    bash \
    git \
    curl \
    unzip \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    $PHPIZE_DEPS

# ===============================
# 2. Устанавливаем PHP-расширения
# ===============================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    intl

# ===============================
# 3. Устанавливаем Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# 4. Настройка рабочей директории
# ===============================
WORKDIR /var/www

# ===============================
# 5. Пользователь (важно!)
# ===============================
RUN addgroup -g 1000 laravel \
    && adduser -G laravel -g laravel -s /bin/sh -D laravel

USER laravel