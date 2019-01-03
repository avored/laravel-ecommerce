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
     * @var \Faker\Generator
     */
    public $faker;

    public function setUp()
    {
        parent::setUp();
        //$this->faker = Factory::create('en_NZ');
    }
}
