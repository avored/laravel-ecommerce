# AvoRed E Commerce is an Laravel Open Source Shopping Cart

[![Total Downloads](https://poser.pugx.org/avored/laravel-ecommerce/downloads)](https://packagist.org/packages/avored/laravel-ecommerce)

AvoRed is a Ecommerce application based on Laravel framework for shopping cart solution.

[AvoRed Laravel E Commerce Official](http://avored.website/)

[Demo AvoRed E Commerce](http://demo.avored.website/)


# Installation

- [Installation](#installation)
    - [Installing AvoRed E cimmerce](#installing-avored-ecommerce)

<a name="installation"></a>
## AvoRed Installation
> 

The AvoRed E commerce framework has a few system requirements.

<a name="installing-avored-ecommerce"></a>
### Installing AvoRed E commerce

AvoRed E commerce utilizes [Composer](https://getcomposer.org) to manage its dependencies. So, before using AvoRed E commerce, make sure you have Composer installed on your machine.

#### Via Composer Create-Project

Alternatively, you may also install Laravel by issuing the Composer `create-project` command in your terminal:

    composer create-project avored/laravel-ecommerce --stability=dev

#### Set up your Envirionment(.env) file

    laravel-ecommerce/.env 
    
### Go to Url
    
    yoursite.com/install
    
That's it!

#### Directory Permissions

After installing AvoRed E commerce, you may need to configure some permissions. Directories within the `storage` and the `public/uploads` directories should be writable by your web server or AvoRed E commerce will not run. 

#### Application Key

The next thing you should do after installing AvoRed E commerce is set your application key to a random string. If you installed AvoRed E commerce via Composer, this key has already been set for you by the `php artisan key:generate` command.

Typically, this string should be 32 characters long. The key can be set in the `.env` environment file. If you have not renamed the `.env.example` file to `.env`, you should do that now. **If the application key is not set, your user sessions and other encrypted data will not be secure!**



## Contributing

AvoRed E commerce is in active development and If you want to contribute in this project then simply do the [Pull Request](https://github.com/avored/laravel-ecommerce/pulls)!

If you find any bug or problem please submit here [AvoRed Ecommerce Forum](http://avored.website/forum/) or [raise the issue here](https://github.com/avored/laravel-ecommerce/issues/new).

[![](https://ga-beacon.appspot.com/UA-79831356-1/laravel-ecommerce?pixel)](https://github.com/avored/laravel-ecommerce)
