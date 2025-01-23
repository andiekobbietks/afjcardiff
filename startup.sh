#!/bin/bash

set -e

# Load environment variables from .env file
if [ -f .env ]; then
    export $(cat .env | xargs)
fi

# Logging function
log() {
    local message="$1"
    local timestamp=$(date +"%Y-%m-%d %H:%M:%S")
    echo "[$timestamp] $message"
}

# Error handling
trap 'log "An error occurred. Exiting..."; exit 1' ERR

# Install Composer if not present
if ! command -v composer &> /dev/null; then
    log "Installing Composer..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    php -r "unlink('composer-setup.php');"
fi

# Install PHP dependencies
log "Installing PHP dependencies..."
composer install

# Setup MySQL directories
log "Setting up MySQL directories..."
mkdir -p /workspace/mysql
mkdir -p /run/mysqld
chown mysql:mysql /run/mysqld

# Initialize MySQL if not already initialized
if [ ! -f "/workspace/mysql/ibdata1" ]; then
    log "Initializing MySQL..."
    mysql_install_db --datadir=/workspace/mysql
fi

# Start MySQL
log "Starting MySQL..."
mysqld --datadir=/workspace/mysql &
sleep 5

# Initialize database
log "Initializing database..."
mysql -u root -e "CREATE DATABASE IF NOT EXISTS ${DB_DATABASE};"

# Import SQL file if exists
if [ -f SQLDatabase/paradigmshift.sql ]; then 
    log "Importing SQL file..."
    mysql -u root ${DB_DATABASE} < SQLDatabase/paradigmshift.sql
fi

# Clean workspace
log "Cleaning workspace..."
git clean -ffdX

# Start PHP development server
log "Starting PHP development server..."
php -S 0.0.0.0:8000
