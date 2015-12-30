
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/13d25ea9-d21c-46f6-8181-427e421844ff/big.png)](https://insight.sensiolabs.com/projects/13d25ea9-d21c-46f6-8181-427e421844ff)
[![Build Status](https://travis-ci.org/Symfomany/laravelcinema.svg?branch=master)](https://travis-ci.org/Symfomany/laravelcinema)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Symfomany/laravelcinema/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Symfomany/laravelcinema/?branch=master)
[![Gitter](https://badges.gitter.im/Symfomany/laravelcinema.svg)](https://gitter.im/Symfomany/laravelcinema?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
[![Coverage Status](https://coveralls.io/repos/Symfomany/laracinema/badge.svg?branch=master&service=github)](https://coveralls.io/github/Symfomany/laracinema?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/13d25ea9-d21c-46f6-8181-427e421844ff/mini.png)](https://insight.sensiolabs.com/projects/13d25ea9-d21c-46f6-8181-427e421844ff)
![Packagist](https://img.shields.io/github/issues/Symfomany/laravelcinema.svg)
![Packagist](https://img.shields.io/packagist/v/symfomany/laravelcinema.svg)
![Packagist](https://img.shields.io/github/forks/Symfomany/laravelcinema.svg)
![Packagist](https://img.shields.io/github/stars/Symfomany/laravelcinema.svg)
![Packagist](https://img.shields.io/twitter/url/https/github.com/Symfomany/laravelcinema.svg?style=social)

## Laravel PHP Project

Pedagogic Project  en **Laravel 5** on CMS like *Allociné*
Propulsed by *Julien Boyer*  julien@meetserious.com


## Install via Composer

* Composer package:   `composer create-project symfomany/laravelcinema`  or just vendor with `composer require symfomany/laravelcinema`
* Manually, Get composer: `curl -sS https://getcomposer.org/installer | php`
* Install the vendor `php compose.phar install`
* Deploy your database in mysql/...sql
* Launch fixtures with php artisan db:seed
* Run the test with Phpunit

## Test

* Run phpunit with `phpunit`
* Run phpspec with `bin/phpspec run`


Technologies
====

* Composer Require
* PHP >= 5.5.9
* Redis server with Predis
* Envoy
* Paypal Account
* OOP Cart with Abstract, INterfacing Exception with IoC Container
* OpenSSL
* Task launch in schedule here * * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
* Faker && Seed
* MongoDB
* Redis
* AngularJS
* Node
* Socket IO
* Gulp
* Bower
* Notification in Suscribers
* Fixtures in seeks
* Faker Objects
* Bootstrapp 3 based on Material Design


Configuration on *.env* file
====

* Define .env file with
+ APP_ENV=local
+ APP_DEBUG=true
+ APP_KEY= ******

+ DB_HOST=localhost
+ DB_DATABASE=db
+ DB_USERNAME=root
+ DB_PASSWORD= ******

+ CACHE_DRIVER=file
+ SESSION_DRIVER=file
+ QUEUE_DRIVER=sync

+ MAIL_DRIVER=smtp
+ MAIL_HOST=mailtrap.io
+ MAIL_PORT=2525
+ MAIL_USERNAME=null
+ MAIL_PASSWORD=null
+ MAIL_ENCRYPTION=null


Demo
====
http://45.55.35.18/index.php/admin
Login: admin@test.com
Mdp: 123456

Data Fixtures
====

    php artisan db:seed

Screenshots
====

![GitHub Logo](/screens/1.png)
![GitHub Logo](/screens/2.png)
![GitHub Logo](/screens/3.png)
![GitHub Logo](/screens/4.png)
![GitHub Logo](/screens/5.png)


### License

*The Laravel project is open-sourced software*
