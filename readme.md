# Mage2 Laravel 5 E commerce

[![Total Downloads](https://poser.pugx.org/mage2/laravel-ecommerce/d/total.svg)](https://packagist.org/packages/mage2/larave-ecommerce)
[![Latest Unstable Version](https://poser.pugx.org/mage2/laravel-ecommerce/v/unstable.svg)](https://packagist.org/packages/mage2/laravel-ecommerce)
[![Analytics](https://ga-beacon.appspot.com/UA-79831356-1/laravel-ecommerce/reademe.md?pixel)](https://github.com/igrigorik/ga-beacon)




Mage2 is a Ecommerce application based on Laravel framework.

### Step 1: Install Mage2 Ecommerce with [Composer](https://getcomposer.org/download/).


Run composer to create the lavender application:

    composer create-project mage2/laravel-ecommerce --stability=dev
    
Set up your environment config file:

    laravel-ecommerce/.env    


### Step 2: Set up Laravel Ecommerce with Artisan.


Run your migration file:

    php artisan migrate

Create Admin:

    php artisan make:admin
    
Install Some Dummy Data (optional):

    php artisan db:seed

That's it!
