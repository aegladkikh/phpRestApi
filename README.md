# REST API для получения курса валют 

**symfony / pgsql / nginx + php-fpm:7.4**

## Setup

- docker-compose up -d
- docker-compose run --rm php composer install
- docker-compose run --rm php php bin/console doctrine:database:create
- docker-compose run --rm php php bin/console make:migration
- docker-compose run --rm php php bin/console doctrine:migrations:migrate
- docker-compose run --rm php php bin/console doctrine:fixtures:load
- docker-compose run --rm php php bin/console currency:update

И далее уже запрос 

GET http://localhost/api/currencies

или

GET http://localhost/api/currency/1

Authorization: Bearer test
