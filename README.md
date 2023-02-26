# Backend

After install this project, then clone & install this frontend :

```sh
https://github.com/do4zero/nawatech.frontend
```

## Backend Installation

Clone and install :

```sh
git https://github.com/do4zero/nawatech.backend
cd backend
composer install
npm install && npm run dev
```

setup your env and add this variable in the last row

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=******
DB_USERNAME=******
DB_PASSWORD=******
...
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
...
FILESYSTEM_DRIVER=public
...
FE_BASE_PATH=http://localhost:8080
```
after installation, run this laravel command

```sh
php artisan key:generate
php artisan migrate:fresh --seed
```

then run this command
```sh
npm install && npm run dev
```

last, serve and run your laravel app
```sh
php artisan serve
```
go to http://localhost:8000 to access this backend application


## Logic Test

For logic test, please run endpoint 
```sh
http://localhost:8000/logictest
```
with POST method from postman or other tools and send this file as parameters

| Body Key  | Content | Location File |
| ------------- | ------------- | ------------- |
| bookings_file  | FILE | root/bookings_file.json |
| workshops_file | FILE  | root/workshops_file.json |
| sort | ASC or DESC  | |
