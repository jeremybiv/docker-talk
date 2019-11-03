<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## App description
Lightning talks are run on a bi​-monthly basis at XXX NZ within the Product division. Every two months, team members will propose topics they would like to share by submitting a topic and synopsis to the organizing committee.
From these submissions, the organizing committee will select THREE of the most interesting topics.
These sessions are run on the first Tuesday of every even ​month (e.g. February, April, ..., December). OBJECTIVE

## How to set up the app using docker
Prepare your .env file there with database connection and other settings especially :
- GOOGLE_*
- MAIL_*

- docker-compose build
- docker-compose exec php php artisan migrate --seed
- docker-compose exec php php artisan passport:install

- docker-compose up -d

- you can reach the new app on https://localhost:8080 
as indicated in your .env file

And that's it, go to your domain and login as an admin :
Email: admin@neighbourly.com
Password: password

OR register :
https://localhost:8080/register

## cloud native architecture AWS  to deploy and run it

https://s3.us-east-2.amazonaws.com/cloudformation-templates-us-east-2/LAMP_Single_Instance.template

