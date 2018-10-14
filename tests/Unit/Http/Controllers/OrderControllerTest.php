<?php

namespace Tests\Feature;

use Stripe\Charge;
use App\Http\Controllers\OrderController;
use Avored\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Payment\Stripe\Payment;
use Avored\Framework\Models\Database\Order;
use Avored\Framework\Models\Database\User;

class OrderControllerTest extends \Tests\TestCase
{
    public $faker;

    private $configMock;

    private $paymentMock;

    private $instance;

    public function setUp()
    {
        parent::setUp();
        $this->configMock = $this->getMockBuilder(ConfigurationInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getValueByKey'])
            ->getMock();

        $this->paymentMock = $this->getMockBuilder(Payment::class)
            ->disableOriginalConstructor()
            ->setMethods(['identifier', 'name', 'enable', 'view', 'with', 'process'])
            ->getMock();

        $this->faker = \Faker\Factory::create();

        $this->instance = new OrderController($this->configMock);
    }

    public function testSuccessPlaceOrderWithConnectedUser()
    {
        $user = factory(\AvoRed\Framework\Models\Database\User::class)->create();
        $this->actingAs($user);

        $requestMock = $this->getMockBuilder(\App\Http\Requests\PlaceOrderRequest::class)
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock->expects($this->any())->method('post')->willReturnOnConsecutiveCalls([
            'user' => [
                'email' => $user->email,
            ],
            'billing' => [
                'id' => 21,  // do mocking?
                'type' => 'BILLING',
                'user_id' => $user->id,
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'phone' => $this->faker->phoneNumber,
                'address1' => $this->faker->streetAddress,
                'country_id' => $this->faker->randomDigitNotNull,
                'state' => $this->faker->country,
                'city' => $this->faker->city,
                'postcode' => $this->faker->postcode,
            ],
            'use_different_shipping_address' => null,
            'shipping_option' => 'livraison',
            'payment_option' => 'bankwire',
            'agree' => true,
        ]);

        $paymentDatas = [
            'shipping_address_id' => 21, // do mocking?
            'billing_address_id' => 21, // do mocking?
            'user_id' => $user->id,
            'shipping_option' => null,
            'payment_option' => null,
            'order_status_id' => 1, // do mocking?
            'currency_code' => 'eur',
        ];

        $chargeMock = $this->getMockBuilder(\Stripe\Charge::class)->disableOriginalConstructor()->getMock();
        $this->configMock->expects($this->exactly(1))->method('getValueByKey')->with('general_site_currency')->willReturn('eur');
        $this->paymentMock->expects($this->exactly(1))->method('process')->with($paymentDatas, [], $requestMock)->willReturn($chargeMock);

        \AvoRed\Framework\Payment\Facade::shouldReceive('get')->once()->andReturn($this->paymentMock);

        $result = $this->instance->place($requestMock);
        $successMsg = 'Product Added to Cart Successfully!';
        $this->assertEquals($successMsg, $result->getSession()->get('notificationText'));
        $this->assertEquals(302, $result->getStatusCode());
    }
}
