<?php
namespace AvoRed\Ecommerce\Repository;

use AvoRed\Ecommerce\Models\Database\Address;
use AvoRed\Ecommerce\Models\Database\AdminUser;
use AvoRed\Ecommerce\Models\Database\Country;
use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Ecommerce\Models\Database\Wishlist;
use AvoRed\Framework\Repository\AbstractRepository;
use AvoRed\Ecommerce\Models\Database\User as UserModel;

class User extends AbstractRepository {


    public function model() {
        return new UserModel();
    }

    public function adminUserModel() {
        return AdminUser();
    }

    public function roleModel() {
        return new Role();
    }

    public function countryModel()
    {
        return new Country();
    }

    public function addressModel(){
        return new Address();
    }

    public function wishlistModel() {
        return Wishlist();
    }
}