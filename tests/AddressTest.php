<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mage2\Address\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddressCreateAndList()
    {
        $this->frontAuthTest();

        $this->visit('/my-account/address/create')
                //->see('Create Address')
                //->type('first name','first_name')
                //->type('last name','last_name')
                //->type('address1','address1')
                //->type('address2','address2')
                //->type('area','area')
                //->type('city','city')
                //->type('state','state')
                //->select('1','country_id')
                //->type('03 123 1234','phone')
                //->select('SHIPPING','type')
                //->press('create_address');
                //->seePageIs('/my-account/address')
                //->see('first name')
                //->see('last name');
            ;

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddressEditAndUpdate()
    {
        $this->frontAuthTest();
        $this->_deleteTestAddress();
        $address = $this->_craeteAddress();

        $this->visit('/my-account/address/'. $address->id . "/edit")
                    ->see('Edit Address')
                    ->seeInField('first_name','first name')
                    ->type('first name new','first_name')
                    ->press('Update Address')
                    ->seePageIs('my-account/address')
                    ->see('first name new')

        ;

        //$this->makeR
    }



    public function testAddressDestroy()
    {
        $this->frontAuthTest();
        $this->_deleteTestAddress();
        $address = $this->_craeteAddress();
        $this->makeRequest("DELETE", "/my-account/address/" . $address->id)
            ->seePageIs('/my-account/address')
            ->dontSee('first name');
    }


    private function _craeteAddress() {
        return Address::create([
                'first_name' => 'first name',
                'last_name' => 'last name',
                'address1' => 'address1',
                'address2' => 'address2',
                'area' => 'area',
                'city' => 'city',
                'state' => 'state',
                'country_id' => '1',
                'phone' => '0 123 234',
                'type' => 'BIllIng',
                'user_id' => Auth::user()->id
            ]);
    }


    public function _deleteTestAddress() {
        //@todo If we run test second time it will fail. (try to use data using faker).
        $user = Auth::user();
        Address::where('user_id', '=', $user->id)->delete();
    }
}
