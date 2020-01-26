#!/usr/bin/env bash
set -euo pipefail

echo '---PHP lint---'
docker run --rm -v $(pwd)/app/src/:/app nexus.action-media.ru/docker-action-base/base-service-php72:latest bash -c "cd /app && find . -name \"*.php\" -print0 | xargs -0 -n1 -P8 php -l"

echo '---Yaml lint---'
docker run --rm -v $(pwd):/app sdesbure/yamllint yamllint -c /app/.yamllint /app/
