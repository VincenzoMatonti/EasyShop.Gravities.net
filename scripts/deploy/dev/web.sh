#!/bin/bash

set -euo pipefail

#######################################
# Configuration
#######################################

IMAGE="${1:-}"

CONTAINER_NAME="easyshop-web"

ENV_FILE="/var/www/easyshop-web/shared/env/.env"

STORAGE_PATH="/var/www/easyshop-web/shared/storage"

CERTS_PATH="/var/www/easyshop-web/shared/certs"

NGINX_SSL_PATH="/etc/nginx/ssl"

#######################################
# Validation
#######################################

if [ -z "$IMAGE" ]; then
    echo "ERROR: Missing docker image"
    exit 1
fi

if [ ! -f "$ENV_FILE" ]; then
    echo "ERROR: Missing env file: $ENV_FILE"
    exit 1
fi

echo "================================"
echo "Deploying Web"
echo "================================"

echo "Image:"
echo "$IMAGE"

#######################################
# Pull image
#######################################

echo ""
echo "Pulling image..."

docker pull "$IMAGE"

#######################################
# Stop old container
#######################################

echo ""
echo "Removing old container..."

docker stop "$CONTAINER_NAME" 2> /dev/null || true

docker rm "$CONTAINER_NAME" 2> /dev/null || true

#######################################
# Start container
#######################################

echo ""
echo "Starting new container..."

docker run -d \
    --name "$CONTAINER_NAME" \
    --restart unless-stopped \
    --env-file "$ENV_FILE" \
    -v "$STORAGE_PATH:/var/www/html/storage" \
    -v "$CERTS_PATH:/etc/secrets" \
    -v "$NGINX_SSL_PATH:/etc/nginx/ssl:ro" \
    -e APP_ROLE=web \
    -p 80:80 \
    -p 443:443 \
    "$IMAGE"

#######################################
# Health check
#######################################

echo ""
echo "Checking container status..."

sleep 5

STATUS=$(docker inspect \
    -f '{{.State.Status}}' \
    "$CONTAINER_NAME")

if [ "$STATUS" != "running" ]; then

    echo "ERROR: Web container failed"

    echo ""
    echo "Container logs:"

    docker logs "$CONTAINER_NAME"

    exit 1

fi

#######################################
# Cleanup
#######################################

echo ""
echo "Cleaning unused images..."

docker image prune -af \
    --filter "until=168h"

echo ""
echo "================================"
echo "Web deployment completed"
echo "================================"
