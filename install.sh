#!/bin/bash

# Laravel installation script
# https://github.com/fraigo/laravel-install-script/

message () {
  echo -e "\033[0;32m$1\033[0m"
}
message "Update dependencies"
composer install

message "Create environment"
### Create initial .env file using the template file .env.example
### Creating a security key for the application
cp .env.example .env
php artisan key:generate


message "Modify config file"
#In laravel-app/config/app.php, change APP_DEBUG to true
#  'debug' => env('APP_DEBUG', true),

message "Starting local application service"
echo "Point your browser to http://localhost:8000/"
php artisan serve
