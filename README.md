![](https://github.com/tvqqq/tvqhub-laravel/workflows/CI/badge.svg)

## Setup Laravel

#### Create folders

```
sudo cp .env.example .env
```

#### Folder permissions

```
sudo chown :www-data app storage bootstrap -R
sudo chmod 775 app storage bootstrap -R
```

#### Install dependencies

```
sudo composer install --optimize-autoloader --no-dev
sudo npm install
```

#### Laravel Prerequisite

```
php artisan key:generate
php artisan migrate
```

---

## Config queue

```
php artisan queue:table

php artisan migrate

(.env) QUEUE_CONNECTION=database
```

### Supervisor

```
sudo apt install supervisor

sudo service supervisor restart
```

### laravel-worker.conf

```
cd /etc/supervisor/conf.d

sudo nano laravel-worker.conf
```

```
[program:laravel-worker-tvqhub]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/tvqhub-laravel/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=root
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/html/tvqhub-laravel/storage/logs/worker.log
stopwaitsecs=3600
```

```
sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl status
```

### Cronjob

```
sudo crontab -e

* * * * * cd /var/www/html/tvqhub-laravel && php artisan schedule:run >> /dev/null 2>&1
```

---

## Deployment

```
php artisan down

gpm (git pull origin master)

php artisan optimize:clear

composer install -o --no-dev

npm install

php artisan optimize

php artisan up
```

---

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
