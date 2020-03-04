<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Deploy Laravel

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

#### Laravel Setup

```
php artisan key:generate
php artisan migrate
```

---

## Config queue

```
php artisan queue:table

php artisan migrate
```

_(.env)_ QUEUE_CONNECTION=database

```
sudo apt install supervisor
```

```
sudo service supervisor restart
```

```
cd /etc/supervisor/conf.d

sudo nano laravel-worker.conf
```

### laravel-worker.conf
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

