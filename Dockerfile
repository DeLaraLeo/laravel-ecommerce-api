FROM php:8.3-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl \
    && docker-php-ext-install opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expor porta 9000 (PHP-FPM)
EXPOSE 9000

# Comando padrão
CMD ["php-fpm"]

