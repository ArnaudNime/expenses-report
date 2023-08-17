build:
	docker-compose rm -f
	docker-compose build --no-cache
	composer install
start:
	docker-compose up -d
stop:
	docker-compose down
	symfony server:stop
test:
	docker-compose exec -it php /var/www/symfony_docker/vendor/bin/phpunit --testsuite unit
	docker-compose exec -it php /var/www/symfony_docker/vendor/bin/phpunit --testsuite http
fixtures:
	docker exec -i postgres psql app -Udev_user < tests/fixtures/user_1.sql
clear-cache:
	docker exec php symfony console cache:clear