
<!-- GETTING STARTED -->
## Getting Started

Brokerage Insurance task(php-laravel).


### important

* create database
* copy ```.env.example``` file and remame it to ```.env```
* conigration database in ```.env```

### inistallation and run

This is an example of how to list things you need to use the software and how to install them.
* back end server
  ```sh
   composer install
   composer require laravel/passport
   php artisan passport:install
   composer require laravel/telescope
   composer dump-autoload
   php artisan telescope:install
   php artisan migrate
   php artisan key:generate
   php artisan optimize:clear
   php artisan db:seed
   php artisan serve
  ```

## Note 
Login http://127.0.0.1:8000/login with email: ```admin@brokerage-insurance.com``` password: ```admin```
 * ```Laravel Framework 8.83.26 ```
 * ```PHP 8.1.0 ```
