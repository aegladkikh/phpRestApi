# testOST

- docker-compose -f docker-compose.yaml up -d
- docker-compose -f docker-compose.yaml down
- docker-compose -f docker-compose.yaml run --rm php composer install
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:database:create
- Выполнять только если нет миграции docker-compose -f docker-compose.yaml run --rm php bin/console make:migration
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:migrations:migrate
- docker-compose -f docker-compose.yaml run --rm php bin/console doctrine:fixtures:load