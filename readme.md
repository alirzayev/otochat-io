# otochat2 socket.io, redis and laravel-echo-server
It is a simple one to one chat application with socket.io, redis and laravel-echo-server

# Installation
before installation make sure your redis server is working well
```bash
$ git clone
$ composer install
$ npm install
$ php artisan migrate
$ redis configuration from .env file
$ php artisan key:gen
$ npm install -g laravel-echo-server 
```
# Run

```bash
$ laravel-echo-server init 
$ npm run watch
$ laravel-echo-server start
$ php artisan serve
```
All is done, check  <http://myproject/conversations>  
from browser.
