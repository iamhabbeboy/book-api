
build_php:
	@echo "Starting PHP..."
	docker-compose build php
	@echo "Done!"

build_nginx:
	@echo "Starting PHP..."
	docker-compose build nginx
	@echo "Done!"

up_build: build_nginx build_php
	@echo "Stopping docker images (if running...)"
	docker-compose down
	@echo "Building (when required) and starting docker images..."
	docker-compose up --build -d
	@echo "Docker images built and started!"

test:
	@echo "Waiting for PHP shell environment"
	docker-compose run --rm php  \
	php artisan test
	@echo "Done!"

shell:
	@echo "Migrating... for PHP shell environment"
	docker exec -it php sh
	@echo "Done!"

