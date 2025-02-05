FROM php:8.3-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required packages and PHP extensions
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        git \
        wget \
        curl \
        --no-install-recommends && \
    docker-php-ext-install pdo pdo_mysql mysqli zip intl opcache && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    rm -rf /var/lib/apt/lists/*


# Install Node.js using NVM
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh | bash && \
    export NVM_DIR="/root/.nvm" && \
    . "$NVM_DIR/nvm.sh" && \
    nvm install 22 && \
    nvm cache clear

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Configure Apache
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# Set working directory and permissions
WORKDIR /var/www
RUN chmod -R 755 /var/www && \
    chown -R www-data:www-data /var/www