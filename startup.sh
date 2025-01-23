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

# Clean workspace
log "Cleaning workspace..."
git clean -ffdX

# Start PHP development server
log "Starting PHP development server..."
php -S 0.0.0.0:8000
