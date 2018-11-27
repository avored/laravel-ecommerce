# Changelog
All notable changes to this project will be documented in this file.

## 2.9.6
 - Menu Group Feature
 - Keep Pick from store as default shipping method
 - Added many unit test
 - Using summernote as text editor
 - Order Product using product_info in the event of deleted product

## 2.9.6
 - HotFix AvoRed DataGrid Collection doesn't exist order by method only works for Eloquent Model
 - HotFix AvoRed Cart Page Sessing class missing
 - Added support for currency symbol
 - Laravel 5.7 upgrade


## 2.9.5.7

### Added
- Added Github release badge to the readme.
- Added new feature **order returns**: this allows your customers to return a product if the product is damaged or if the customer just dont like the item.
- Added another database table field for properties table: is_visible_frontend.
- Remove hard coded currency code.
- Added Laravel Self-Diagnosis package and added code into an `avored:install` command to check if there is an error then it won't allow you to installed it.

### Fixed
Updated Dockerfile to use Ubuntu 18.04 and PHP7.2.

## 2.9.5.6

### Fixed
- Fixed backend theme

## 2.9.5
### Added

### Fixed
- Admin Product Attribute Save Bug fixed: $option does not exists.
- fixed some cart price & tax amount bug.
- Added an Permission Group Callable Add functionality.
- Added an newly added route permission into Permission Provider.
- Fixed Product Image Path related bug.
- Feature Added an monthly revenue widget.
- Added grumphp to improve code styling.

## 2.9.4
### Added
- Reduce Page Size by using an DataGrid on Theme and Module List Page
- Admin Country CRUD so store admin can add/edit/delete possible countries
- Admin State CRUD so store admin can add/edit/delete possible states
- Admin order status CRUD so store admin can add/edit/delete possible custom order status 
- Admin can add tracking number to an order
- Added Recent Order Widget to Admin Dashboard
- Admin Users CRUD so store admin can add/edit/delete possible Users 
- Admin User Show display user order list as well
- Admin can change User Password from admin and Mail gets sent to user
- Admin User Group CRUD so store admin can add/edit/delete User Groups 
- Replace Module/Theme list with DataGrid

### Fixed


## 2.9.3
### Added
- Added a changelog to see precisely what changes have been made between each release.
- Setup Category API with Passport Auth and Resource.
- Setup Property API with the help of Laravel API Resource.
- Setup Attribute API with the help of Laravel API Resource.
- Setup Page API with the help of Laravel API Resource.
- Setup Product API with the help of Laravel API Resource.
- Disabled Admin User If user is Super admin
- Setup Breadcrumb for Admin Cms Page Index,Edit & Create Route.
- Setup SweeetAlert Before Product Delete.
- Setup SweeetAlert Before Subscribe User Delete.
- Setup SweeetAlert Before User Role Delete.
- Setup SweeetAlert Before Site Currency Delete.
- Setup SweeetAlert Before Banner Delete.
- Setup SweeetAlert Before CMS Page Delete.
- Setup SweeetAlert Before Product Attribute Delete.
- Setup SweeetAlert Before Product Property Delete.
- Setup SweeetAlert Before Product Category Delete.


### Fixed
- CSS issue on Order page with the Options dropdown.
