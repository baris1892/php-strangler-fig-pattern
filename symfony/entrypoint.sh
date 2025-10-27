#!/bin/bash
set -e # Aborts script if any command fails

# 1. Create necessary directories if they don't exist.
echo "Creating missing directories in /app/var..."
mkdir -p /app/var/cache
mkdir -p /app/var/log

# 2. Corrects the permissions for Symfony var/cache and var/log.
echo "Setting permissions for /app/var/cache and /app/var/log..."
chown -R www-data:www-data /app/var
chmod -R 775 /app/var/cache
chmod -R 775 /app/var/log
echo "Permissions set."

# 3. Starts the Apache web server explicitly in the foreground.
echo "Starting Apache..."
/usr/sbin/apache2ctl -D FOREGROUND