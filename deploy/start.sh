#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "queue" ]; then

    echo "Running the queue..."
    php /var/www/spark gps:worker

fi