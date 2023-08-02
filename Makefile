build:
	docker-compose rm -f
	docker-compose build --no-cache
start:
	docker-compose up -d
	symfony server:start --no-tls
fixtures:
	docker exec -i postgres psql app -Udev_user < test/fixtures/user_1.sql