# AvoRed Banner Module

### Installation

    composer require avored/related 
    
    php artisan migrate

### How to Use

Visit Admin Product Edit Page.

Click on Related Product Accordion you see a grid with checkbox.

Select your Related Product ans click Save.

##### How to include a Related Product Cards into Front End theme?

Open your Product view template in most case it should be: 

`themes/vendor/theme/views/product/view.blade.php` include a below code where you like related product to display.

    @include('avored-related::related.product.list')
    
    