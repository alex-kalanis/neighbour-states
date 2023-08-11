#!/bin/sh
# run things inside the php container
# init storage
chmod -R 777 ./application/storage
# copy .env
cp ./application/.env.devel ./application/.env
# run migrations
echo "Migrate tables and data"
php8.1 artisan migrate:fresh
echo "Tables migrated"
# now get the data from remote
php8.1 artisan load-queue
