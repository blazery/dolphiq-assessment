## About Project
A quick setup for a shopping list api made in laravel v10 with php v8.1. This project has no longterm support of anykind, does not scale with cloud, and is not containerized. Complains can be filled at: blazery@fakeemail.com.

## Instalation guide
To run this projects your system will need php8.1 with a giant list of extension. On linux you can run the follow command to set this up for you.

`sudo apt install openssl php8.1 php8.1-bcmath php8.1-curl php8.1-fmp php8.1-mbstring php8.1-mysql php8.1-tokenizer php8.1-xml php8.1-zip php8.1-sqlite3`

After this composer will be needed to install all dependancies the lastest version of composer can be installed using the following [guide](https://getcomposer.org/download/). I intentionally did not include the script here, requisted by the developers of Composer.

Next up install the projects dependancies by running `composer install` in the projects directory.

To start developing run `php artisan serve`, this should get you started without having to setup an Apache server, possibly nginx or php-fmp. 


## TODO's by priority

* Extended testing [x]
* Input validation [x]
* Resource models instead of models
* Authorization
* Authentication
* WSL 2 install
  * With docker