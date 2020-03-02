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

## Run production environment

```
npm run watch
```

```
php artisan serve --host 0.0.0.0
```
