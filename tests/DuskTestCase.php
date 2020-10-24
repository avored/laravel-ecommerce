<?php

namespace Tests;

use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Contracts\CustomerGroupModelInterface;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\Testing\WithFaker;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }


    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories();
        $this->artisan('migrate:fresh');
        $this->artisan('storage:link');
       
        $roleData = ['name' => Role::ADMIN];

        $roleRepository = app(RoleModelInterface::class);
        $roleRepository->create($roleData);

        $this->createCurrency();
        $this->createLanguage();
        $this->createDefaultCustomerGroup();
        $this->createOrderStatus();

        // Create an Admin User Here
        $this->artisan('vendor:publish', ['--provider' => AvoRedProvider::class]);

    }


    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            //'--disable-gpu',
           // '--headless',
            //'--window-size=1920,1080',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * Get the Default currency data.
     * @return void
     */
    public function createCurrency()
    {
        $data = [
            'name' => 'US Dollar',
            'code' => 'usd',
            'symbol' => '$',
            'conversation_rate' => 1,
            'status' => 'ENABLED',
        ];
        $currencyRepository = app(CurrencyModelInterface::class);
        $currencyRepository->create($data);
    }

    /**
     * Get the Default currency data.
     * @return void
     */
    public function createDefaultCustomerGroup()
    {
        $data = [
            'name' => 'Default Group',
            'is_default' => 1,
        ];
        $customerGroupRepository = app(CustomerGroupModelInterface::class);
        $customerGroupRepository->create($data);
    }

    /**
     * create order status.
     * @return void
     */
    public function createOrderStatus()
    {
        $orderStatusRepository = app(OrderStatusModelInterface::class);
        $defaultStatus = $orderStatusRepository->create(['name' => 'Pending']);
        $defaultStatus->is_default = 1;
        $defaultStatus->save();
        $orderStatusRepository->create(['name' => 'Processing']);
        $orderStatusRepository->create(['name' => 'Completed']);
    }

    /**
     * Get the Language data.
     * @return void
     */
    public function createLanguage()
    {
        $data = [
            'name' => 'English',
            'code' => 'en',
            'is_default' => 1,
        ];
        $languageRepository = app(LanguageModelInterface::class);
        $languageRepository->create($data);
    }

    /**
     * With Factories PAth of an avored too
     */
    public function withFactories()
    {
        $factory = app(EloquentFactory::class);
        $path = base_path('vendor/avored/framework/database/factories');
        $factory->load($path);

    }
}
