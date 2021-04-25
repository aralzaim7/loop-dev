# docker-skeleton
Docker Skeleton for Ubuntu 20.04, php, php-fpm, nginx, mysql - ready for Laravel

## Creating New Laravel Project
```
cd Code/new-project

docker run --rm -it \
    -v $(pwd):/opt \
    -w /opt shippingdocker/php-composer:latest \
    composer create-project laravel/laravel new-project
```
