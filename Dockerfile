FROM php:7.3-fpm-alpine

WORKDIR /var/www

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    imagemagick-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    sqlite-dev

# Install production dependencies
RUN apk add --no-cache \
    bash \
    curl \
    g++ \
    gcc \
    git \
    imagemagick \
    libc-dev \
    libpng-dev \
    make \
    mysql-client \
    nodejs \
    nodejs-npm \
    yarn \
    openssh-client \
    postgresql-libs \
    rsync \
    zlib-dev \
    libzip-dev

# Install PECL and PEAR extensions
RUN pecl install \
    imagick \
    xdebug

# Install and enable php extensions
RUN docker-php-ext-enable \
    imagick \
    xdebug
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install \
    curl \
    exif \
    iconv \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pcntl \
    xml \
    gd \
    zip \
    bcmath

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1


RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer


COPY src/composer.json ./
COPY src/composer.lock ./
RUN composer install --no-scripts --no-autoloader && \
    composer clear-cache
COPY src ./
RUN composer dump-autoload --no-scripts --no-dev --optimize
# Cleanup dev dependencies
RUN apk del -f .build-deps


RUN php artisan config:cache

RUN php artisan vendor:publish --tag=lfm_config
RUN php artisan vendor:publish --tag=lfm_public

#RUN php artisan key:generate
#RUN php artisan migrate --seed
# RUN php artisan passport:install
RUN npm install
RUN npm run dev

