#!/bin/bash

set -e

IMAGE=$1

CONTAINER_NAME="easyshop-web"

ENV_FILE="/var/www/easyshop-web/shared/env/.env"

if [ -z "$IMAGE" ]; then
    echo "Missing docker image"
    exit 1
fi

if [ ! -f "$ENV_FILE" ]; then
    echo "Missing env file: $ENV_FILE"
    exit 1
fi

echo "Deploying web..."

echo "Image: $IMAGE"

echo "Pulling image..."
docker pull $IMAGE

echo "Stopping old container..."
docker stop $CONTAINER_NAME || true
docker rm $CONTAINER_NAME || true

echo "Starting new web container..."

docker run -d \
    --name $CONTAINER_NAME \
    --restart unless-stopped \
    --env-file /var/www/easyshop-web/shared/env/.env \
    -v /var/www/easyshop-web/shared/storage:/var/www/html/storage \
    -v /var/www/easyshop-web/shared/certs:/etc/secrets \
    -e APP_ROLE=web \
    -p 80:80 \
    $IMAGE

echo "Cleaning old images..."

docker image prune -f

echo "Checking container..."

sleep 5

if ! docker ps | grep $CONTAINER_NAME; then
    echo "Web container failed to start"
    docker logs $CONTAINER_NAME
    exit 1
fi

echo "Web deployment completed"
