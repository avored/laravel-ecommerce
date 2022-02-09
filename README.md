<p align="center"><a href="https://avored.com" target="_blank"><img src="https://raw.githubusercontent.com/avored/framework/main/logo.svg" width="400"></a></p>

# AvoRed an laravel headless e commerce 

A  heardless e commerce GraphQL API which uses Laravel as a backend.

## Installation 

##### Backend APP setup 

First thing first we will install laravel backend api service. First thing first we will install the laravel app. 

    composer create-project laravel/laravel avored-backend
    cd avored-backend
    composer require avored/framework
    composer require avored/dummy-data
    composer require avored/cash-on-delivery
    composer require avored/pickup

Set up your .env values and CORS

To fixed the CORS in your laravel8 app. You can open `config/cors.php` and replace the code like below in the file.

    'allowed_origins' => ['http://localhost:8080'],


Once the .env setup is done then we can install the AvoRed E commerce

    php artisan avored:install
    php artisan vendor:publish --provider="AvoRed\Framework\AvoRedServiceProvider"
    yoursite.com/graphiql

Once the avored/framework has been installed after that we will make sure we setup the CORS to allow access of an graphql api via any frontend.

##### Frontend APP Setup

    git clone https://github.com/avored/laravel-ecommerce avored-frontend
    cd avored-frontend
    npm install
    npm run serve


#### Installation via Docker

Comming soon. I would welcome the installation docs or any other type of document help.
