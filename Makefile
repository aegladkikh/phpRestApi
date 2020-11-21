up:
	docker-compose up -d
upp:
	docker-compose up --build -d
down:
	docker-compose down
logs:
	docker-compose logs
cc:
	docker-compose run --rm php php bin/console cache:clear
comi:
	docker-compose run --rm php composer install
comu:
	docker-compose run --rm php composer update
installApp:
	docker-compose run --rm php php bin/console doctrine:database:create && docker-compose run --rm php php bin/console make:migration && docker-compose run --rm php php bin/console doctrine:migrations:migrate && docker-compose run --rm php php bin/console doctrine:fixtures:load && docker-compose run --rm php php bin/console currency:update
app:
	docker-compose run --rm php php bin/console doctrine:fixtures:load && docker-compose run --rm php php bin/console currency:update
cur:
	docker-compose run --rm php php bin/console currency:update
