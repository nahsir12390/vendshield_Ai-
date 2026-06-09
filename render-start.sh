#!/usr/bin/env bash
set -e

PORT="${PORT:-10000}"

php artisan config:clear --no-ansi
php artisan route:clear --no-ansi
php artisan view:clear --no-ansi

php artisan serve --host=0.0.0.0 --port="$PORT"
