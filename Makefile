build:
	docker-compose rm -f
	docker-compose build --no-cache
start:
	docker-compose up -d
	symfony server:start --no-tls
stop:
	docker-compose down
	symfony server:stop
test:
	./vendor/bin/phpunit --testsuite unit
	./vendor/bin/phpunit --testsuite http
fixtures:
	docker exec -i postgres psql app -Udev_user < tests/fixtures/user_1.sql