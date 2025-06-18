#!/bin/bash

until mysqladmin ping -h laravel_db --silent; do
	echo "Czekam na baze danych..."
	sleep 2
done


echo "Instalowanie zaleznosci composera..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts --no-progress

echo "Wykonywanie migracji"
php artisan migrate

echo "Nadawanie uprawnien"
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache

chmod -R 775 storage
chmod -R 775 bootstrap/cache

php artisan cache:clear

apache2-foreground
