#!/usr/bin/env bash
set -euo pipefail

echo '--Docker-compose up--'
docker-compose up -d --build
echo '--Composer install--'
docker-compose exec app composer install
echo '--Applying migrations--'
docker-compose exec app bin/console doctrine:migrations:migrate -n
docker-compose exec test bin/console doctrine:migrations:migrate -n
echo '--Load fixtures on test database--'
docker-compose exec test bin/console doctrine:fixtures:load -n  --purge-with-truncate
