# Тестовая REST API для получения курс валют
=================================

# symfony / pgsql / nginx + php-fpm:7.4

## Setup

- docker-compose -f docker-compose.yaml up -d
- docker-compose -f docker-compose.yaml run --rm php composer install
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:database:create
- docker-compose -f docker-compose.yaml run --rm php bin/console make:migration
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:migrations:migrate
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:fixtures:load
- docker-compose -f docker-compose.yaml run --rm php bin/console currency:update

И далее уже запрос 

GET http://localhost/currencies

Authorization: Bearer test

{"page":1}

или

GET http://localhost/currency/1

Authorization: Bearer test
