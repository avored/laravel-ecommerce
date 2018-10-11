<?php

namespace Tests\Feature;

use App\Http\Controllers\OrderController;
use Avored\Framework\Models\Contracts\ConfigurationInterface;
use Avored\Framework\Models\Database\Order;
use Avored\Framework\Models\Database\User;

class OrderControllerTest extends \Tests\TestCase
{

    public $faker;

    private $configMock;

    private $instance;

    public function setUp()
    {
        parent::setUp();
        $this->configMock = $this->getMockBuilder(ConfigurationInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->faker = \Faker\Factory::create();

        $this->instance = new OrderController($this->configMock);
    }

    public function testSuccessPlaceOrder()
    {
        $response = $this->post('/order', [
            'user' => [
                'email' => $this->faker->email,
            ],
            'billing' => [
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'address1' => $this->faker->streetAddress,
                'country_id' => $this->faker->randomDigitNotNull,
                'state' => $this->faker->country,
                'city' => $this->faker->city,
                'postcode' => $this->faker->postcode,
            ],
            'use_different_shipping_address' => false,
            'shipping_option' => 'livraison',
            'payment_option' => 'bankwire',
            'agree' => true,
        ]);

        $response->assertStatus(302);
    }

}
