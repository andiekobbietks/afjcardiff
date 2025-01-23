#!/bin/bash

# Install Composer if not present
if ! command -v composer &> /dev/null; then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    php -r "unlink('composer-setup.php');"
fi

# Install PHP dependencies
composer install

# Setup MySQL directories
mkdir -p /workspace/mysql
mkdir -p /run/mysqld
chown mysql:mysql /run/mysqld

# Initialize MySQL if not already initialized
if [ ! -f "/workspace/mysql/ibdata1" ]; then
    mysql_install_db --datadir=/workspace/mysql
fi

# Start MySQL
mysqld --datadir=/workspace/mysql &
sleep 5

# Initialize database
mysql -u root -e "CREATE DATABASE IF NOT EXISTS afjcardiff_db;"

# Import SQL file if exists
if [ -f SQLDatabase/paradigmshift.sql ]; then 
    mysql -u root afjcardiff_db < SQLDatabase/paradigmshift.sql
fi

# Start PHP development server
php -S 0.0.0.0:8000
