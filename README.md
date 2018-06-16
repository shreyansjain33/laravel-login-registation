# Laravel - Login, Registration, Email Verification

A simple [Laravel 5.6](http://www.laravel.com/) application template to start with. It implements basic features like:
* User Registration
* Email Account Verification
* User Login
* Captcha secured forms
* Password Reset


## Pre Requisites

> Composer -> Latest Version
> Laravel -> v5.6


## Installation

> Update your composer installation with ```composer global self-update```.
> Update your packages with ```composer update``` or install with ```composer install```.

> In Windows, you'll need to include the GD2 DLL `php_gd2.dll` in php.ini. And you also need include `php_fileinfo.dll` and `php_mbstring.dll` to fit the requirements of `mews/captcha`'s dependencies.

> After composer and dependencies/packages installation, copy the .env file ```cp .env.example .env```.
> Geerate the unique application key ```php artisan key:generate```.


## Running

> Run the application using the command ```php artisan serve```.
> Server is started by default at ```http://localhost:8000```.


## Links
* [L5 Captcha on Github](https://github.com/mewebstudio/captcha)
* [License](http://www.opensource.org/licenses/mit-license.php)
* [Laravel website](http://laravel.com)