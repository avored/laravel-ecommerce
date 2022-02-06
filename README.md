<p align="center"><a href="https://avored.com" target="_blank"><img src="https://raw.githubusercontent.com/avored/framework/main/logo.svg" width="400"></a></p>

# AvoRed an laravel headless e commerce 

A  heardless e commerce GraphQL API which uses Laravel as a backend.

## Installation 

##### Backend APP setup 

First thing first we will install laravel backend api service. First thing first we will install the laravel app. 

    composer create-project laravel/laravel avored-backend
    cd avored-backend
    composer required avored/framework
    composer required avored/dummy-data
    composer required avored/cash-on-delivery
    composer required avored/pickup

Set up your .env values. 
Once the .env setup is done then we can install the AvoRed E commerce

    php artisan avored:install
    yoursite.com/graphiql

Once the avored/framework has been installed after that we will make sure we setup the CORS to allow access of an graphql api via any frontend.

##### Frontend APP Setup

    git clone https://github.com/avored/laravel-ecommerce avored-frontend
    cd avored-frontend
    npm install
    npm run serve


#### Installation via Docker

Comming soon. I would welcome the installation docs or any other type of document help.
