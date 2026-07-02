#!/bin/sh
set -e

echo "Menunggu database siap..."
MAX_TRIES=15
COUNT=0

until php artisan migrate:status > /tmp/db_check.log 2>&1; do
  COUNT=$((COUNT+1))
  echo "Database belum siap (percobaan $COUNT/$MAX_TRIES)..."
  cat /tmp/db_check.log
  if [ "$COUNT" -ge "$MAX_TRIES" ]; then
    echo "Gagal konek database setelah $MAX_TRIES percobaan. Lanjut paksa migrate..."
    break
  fi
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