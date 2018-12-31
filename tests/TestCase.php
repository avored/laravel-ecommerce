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
     * FRONT  PASSWORD
     * @var string
     */
    public $userPassword;

    /**
     * @var \Faker\Generator
     */
    public $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create('en_NZ');
    }

    public function getFrontUser()
    {
        $this->userPassword = 'admin123';
        $user = User::create(['first_name' => 'Test Name',
            'last_name' => 'Last Name',
            'email' => $this->faker->email,
            'password' => bcrypt($this->userPassword)
        ]);

        return $user;
    }
}
