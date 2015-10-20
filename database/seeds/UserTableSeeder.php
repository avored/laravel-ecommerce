<?php

use Mage2\Core\Model\Category;
use Illuminate\Database\Seeder;

use Mage2\Core\Model\User;
use Mage2\Core\Model\Entity;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'first_name' => "Admin",
             'last_name' => 'Admin',
            'email' => "ind.purvesh@gmail.com",
            'password' => bcrypt("admin123"),
        ]);
         
         Entity::create(['name' => 'Product', 'unique_key' => 'product']);
         Entity::create(['name' => 'Category', 'unique_key' => 'category']);

        //Think again... do we need root category???
        //Category::create(['name' => 'Root', 'slug' => 'root', 'status' => 1, 'parent_category_id' => 0]);
    }
}
