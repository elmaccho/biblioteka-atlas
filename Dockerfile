FROM php:8.2-apache as web

RUN apt-get update && apt-get install -y \
	libzip-dev \
	zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql zip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts --no-progress

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN apt-get update && \
    apt-get install -y --no-install-recommends default-mysql-client && \
    docker-php-ext-install pdo_mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*



COPY start.sh /start.sh

RUN chmod +x /start.sh

ENTRYPOINT ["/start.sh"]
