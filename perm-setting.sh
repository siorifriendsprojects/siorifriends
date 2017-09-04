#!/bin/bash
cp -p .env.example .env
php artisan key:generate
sudo chown www-data:www-data -R ./storage
sudo chmod 775 -R ./storage
sudo chown www-data:www-data -R ./bootstrap/cache
sudo chmod 775 -R ./bootstrap/cache
sudo chown www-data:www-data ./bootstrap
sudo chmod 775  ./bootstrap
