#!/usr/bin/env sh

# install this application, so it's simple to run it
# at first run docker
docker-compose up -d
echo "Wait for db boot"
sleep 5
# then run things inside php - migrations
docker exec -it testing-neighbour-states-php8 /bin/sh first_run.sh
# now you're good
