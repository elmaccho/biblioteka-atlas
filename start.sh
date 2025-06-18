#!/bin/bash

until mysqladmin ping -h laravel_db --silent; do
	echo "Czekam na baze danych..."
	sleep 2
done


echo "Instalowanie zaleznosci composera..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts --no-progress


echo "Wykonywanie migracji"
php artisan migrate

apache2-foreground
