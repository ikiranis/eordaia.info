![image]

[image]:https://apps4net.eu/assets/static/eordaia_info.21bf951.c35e2b9199554a3b291080ce3e31deb1.jpg

# Eordaia.info site

Ειδησεογραφικό site για την περιοχή της Εορδαίας. (δεν λειτουργεί πλέον)

https://apps4net.eu/eordaia/

## Install Docker container

https://github.com/ikiranis/apache-mysql-for-laravel

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

- If you have a problem with memory limit on ``composer update``, use this

```
COMPOSER_MEMORY_LIMIT=-1 composer update
```
