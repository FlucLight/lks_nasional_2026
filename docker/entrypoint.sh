#!/bin/sh
set -e

echo "Menunggu database siap..."
until php artisan db:show > /dev/null 2>&1; do
  echo "Database belum siap, coba lagi dalam 2 detik..."
  sleep 2
done

echo "Menjalankan migration..."
php artisan migrate --force

echo "Cache config & route..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Menjalankan storage link..."
php artisan storage:link || true

echo "Semua siap, menjalankan supervisor..."
exec "$@"