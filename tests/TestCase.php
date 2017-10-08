<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var \Faker\Generator
     */
    protected $faker;
    public function setUp() {

        parent::setUp();

        $this->faker = Factory::create('en_NZ');

    }
}
