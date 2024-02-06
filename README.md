## Deployment

1. composer install
2. docker-compose down --volumes
2. ./vendor/bin/sail up -build

## Inside "laravel.test" container

1. php artisan migrate:fresh --seed
2. For run test: php artisan test
3. For generating documentation: php artisan l5-swagger:generate 
4. Check documentation by address /api/documentation
