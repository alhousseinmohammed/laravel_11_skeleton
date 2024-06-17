# Run PHP Code Sniffer
lint:
	./vendor/bin/phpcs ./app --standard=PSR2 --ignore=vendor,bootstrap  --exclude=Generic.Commenting.DocComment

# Fix PHP Code Sniffer violations
fix:
	./vendor/bin/phpcbf . --ignore=vendor,bootstrap

# Run PHPUnit tests
test:
	./vendor/bin/phpunit

# Install Composer dependencies
install:
	composer install

seed:
	php artisan db:seed --class=RolePermissionSeeder
	php artisan db:seed --class=AdminUserSeeder

dangerous-regenerate-db:
	php artisan migrate:fresh --seed

update:
	composer update

# Clear application cache
clear-cache:
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear

# Serve the application
serve:
	php artisan serve

# Serve the application
prepare-server:
	chmod +x ./scripts/preare_server_for_laravel.sh
	sudo ./scripts/preare_server_for_laravel.sh

# Run all checks and tests
check: lint test

.PHONY: lint fix test install update clear-cache reset serve check

