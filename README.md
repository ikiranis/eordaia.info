# Eordaia.info site

## Login to container

```
docker exec -it app_fpm /bin/bash
```

## Install npm dependencies

```
npm install
```

## Install laravel dependencies

```
compose update
```

## Run development environment

```
npm run dev
```

```
php artisan serve --host 0.0.0.0
```

## Install production env

- Install laravel/mysql docker

https://github.com/ikiranis/apache-mysql-for-laravel

- Clone project

- Create upload folder

```
mkdir public/uploads
chmod 777 public/uploads -R
```

- Run

```
composer install
npm install

php artisan migrate
php artisan key:generate
php artisan db:seed --class=StartSeeder

npm run prod
```
