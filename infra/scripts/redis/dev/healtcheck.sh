#!/bin/sh

set -e

redis-cli \
    -a "${REDIS_PASSWORD}" \
    ping | grep PONG
