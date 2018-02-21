# Mage2 E Commerce is an Laravel Open Source Shopping Cart

[![Total Downloads](https://poser.pugx.org/mage2/laravel-ecommerce/downloads)](https://packagist.org/packages/mage2/laravel-ecommerce)

Mage2 is a Ecommerce application based on Laravel framework for shopping cart solution.

[Mage2 Laravel E Commerce Official](http://mage2.website/)

[Demo Mage2 E Commerce](http://demo.mage2.website/)


# Installation

- [Installation](#installation)
    - [Installing Mage2 E cimmerce](#installing-mage2-ecommerce)

<a name="installation"></a>
## Installation
> 

The Mage2 E commerce framework has a few system requirements.

<a name="installing-mage2-ecommerce"></a>
### Installing Mage2 E commerce

Mage2 E commerce utilizes [Composer](https://getcomposer.org) to manage its dependencies. So, before using Mage2 E commerce, make sure you have Composer installed on your machine.

#### Via Composer Create-Project

Alternatively, you may also install Laravel by issuing the Composer `create-project` command in your terminal:

    composer create-project mage2/laravel-ecommerce --stability=dev

#### Set up your Envirionment(.env) file

    laravel-ecommerce/.env 
    
### Go to Url
    
    yoursite.com/install
    
That's it!

#### Directory Permissions

After installing Mage2 E commerce, you may need to configure some permissions. Directories within the `storage` and the `public/uploads` directories should be writable by your web server or Mage2 E commerce will not run. 

#### Application Key

The next thing you should do after installing Mage2 E commerce is set your application key to a random string. If you installed Mage2 E commerce via Composer, this key has already been set for you by the `php artisan key:generate` command.

Typically, this string should be 32 characters long. The key can be set in the `.env` environment file. If you have not renamed the `.env.example` file to `.env`, you should do that now. **If the application key is not set, your user sessions and other encrypted data will not be secure!**



## Contributing

Mage2 E commerce is in active development and If you want to contribute in this project then simply do the [Pull Request](https://github.com/mage2/laravel-ecommerce/pulls)!

If you find any bug or problem please submit here [Mage2 Ecommerce Forum](http://mage2.website/forum/) or [raise the issue here](https://github.com/mage2/laravel-ecommerce/issues/new).

[![](https://ga-beacon.appspot.com/UA-79831356-1/laravel-ecommerce?pixel)](https://github.com/mage2/laravel-ecommerce)
