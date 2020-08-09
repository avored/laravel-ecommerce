<?php

namespace Tests\Browser;

use App\User;
use AvoRed\Framework\Database\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $customer = factory(User::class)->create();

        dd($customer);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee(__('avored.pages.login.title'))
                    ->type('');
        });
    }
}
