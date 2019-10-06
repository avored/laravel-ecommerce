# AvoRed Product Review

### Installation

    composer require avored/review 
    
    php artisan migrate


##### How to include a Review View File into Product Card

Open your Product view template in most case it should be: 

`themes/vendor/theme/views/product/view.blade.php` include a below code where you like related product to display.

    @include('avored-review::product.review')
    
If someone else submit an review in front end then you can see it on admin and click approve button to display on product page.
    
    