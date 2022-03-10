<p align="center"><a href="https://avored.com" target="_blank"><img src="https://raw.githubusercontent.com/avored/framework/main/logo.svg" width="400"></a></p>

# AvoRed an laravel headless e commerce 

A  headless e commerce GraphQL API which uses Laravel as a backend.

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

Execute the below command:

    git clone https://github.com/avored/docker-dev.git
    cd docker-dev

    git clone https://github.com/avored/laravel-ecommerce ./src/frontend
    docker-compose up -d
    docker-compose run --rm composer create-project laravel/laravel:8.6 ./
    docker-compose run --rm composer require avored/framework
    docker-compose run --rm composer require avored/dummy-data avored/cash-on-delivery avored/pickup

Now setup `.env` file. Open a avored app .env file which is located at `./src/backend/.env` then setup your database and any other env as per your docker-compose.yml file

    DB_HOST=mysql
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

Now we just have to install the AvoRed and create an avored admin user account

    docker-compose run --rm artisan avored:install
    docker-compose run --rm artisan vendor:publish --provider="AvoRed\Framework\AvoRedServiceProvider"

Now we need to setup CORS so frontend application can receive api call from backnd.
Open `./src/backend/config/cors.php` then replace the below line

        'paths' => ['/graphql', 'sanctum/csrf-cookie'],
        'allowed_origins' => ['http://localhost:8060'],

That's It. Now you can visit `http://localhost:8060` for frontend and for backend you can visit `http://localhost:8050/admin`
