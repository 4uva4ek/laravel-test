## Deployment

1. composer install
2. docker-compose down --volumes
2. ./vendor/bin/sail up -build

## Inside "laravel.test" container

1. php artisan migrate:fresh --seed

## For testing

1. php artisan test

## For generating documentation

* php artisan l5-swagger:generate
* get access by /api/documentation
