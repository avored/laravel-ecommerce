<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;
use Mage2\Ecommerce\Models\Database\AdminUser;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Admin PASSWORD
     * @var string
     */
    public $adminUserPassword;

    /*
     *
     * @var \Mage2\Ecommerce\Models\Database\AdminUser
     */
    public $adminUser;
    /**
     * @var \Faker\Generator
     */
    public $faker;



    public function setUp() {
        parent::setUp();

        $this->faker = Factory::create('en_NZ');
        $this->adminUser = $this->createAdminUser();
    }

    public function createAdminUser() {

        $this->adminUserPassword = 'admin123';

        $user = AdminUser::create(['first_name' => 'Test Name',
                                    'last_name' => 'Last Name',
                                    'email' => $this->faker->email,
                                    'password' => bcrypt($this->adminUserPassword),
                                    'role_id' => 1
                                ]);

        return $user;
    }

}
