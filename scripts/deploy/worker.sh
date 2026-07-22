#!/bin/bash

set -e

IMAGE=$1

CONTAINER_NAME="easyshop-worker"

ENV_FILE="/var/www/easyshop-worker/shared/env/.env"

if [ -z "$IMAGE" ]; then

    echo "Missing docker image"

    exit 1

fi

if [ ! -f "$ENV_FILE" ]; then

    echo "Missing env file: $ENV_FILE"

    exit 1

fi

echo "Deploying worker..."

echo "Image: $IMAGE"

echo "Pulling image..."

docker pull $IMAGE

echo "Stopping old container..."

docker stop $CONTAINER_NAME || true

docker rm $CONTAINER_NAME || true

echo "Starting new worker container..."

docker run -d \
    --name $CONTAINER_NAME \
    --restart unless-stopped \
    --env-file $ENV_FILE \
    -e APP_ROLE=worker \
    $IMAGE

echo "Cleaning old images..."

docker image prune -f

echo "Checking container..."

sleep 5

if ! docker ps | grep $CONTAINER_NAME; then

    echo "Worker failed to start"

    docker logs $CONTAINER_NAME

    exit 1

fi

echo "Worker deployment completed"
