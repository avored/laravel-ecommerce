<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\AdminUser;
use AvoRed\Framework\Models\Database\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Admin PASSWORD
     * @var string
     */
    public $adminUserPassword;



    /**
     * FRONT  PASSWORD
     * @var string
     */
    public $userPassword;

    /*
     *
     * @var \AvoRed\Framework\Models\Database\AdminUser
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
                                    'is_super_admin' => true,
                                    'email' => $this->faker->email,
                                    'password' => bcrypt($this->adminUserPassword),
                                    'role_id' => 1
                                ]);

        return $user;
    }
    public function getFrontUser() {

        $this->userPassword = 'admin123';

        $user = User::create(['first_name' => 'Test Name',
            'last_name' => 'Last Name',
            'email' => $this->faker->email,
            'password' => bcrypt($this->userPassword)
        ]);

        return $user;
    }

}
