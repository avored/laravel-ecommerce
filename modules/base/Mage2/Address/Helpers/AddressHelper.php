<?php
namespace Mage2\Address\Helpers;

use Mage2\Framework\Support\Helper;
use Mage2\TaxClass\Models\Country;
use Illuminate\Database\Eloquent\Collection;


class AddressHelper extends Helper{
    
    /**
     * Get the list of the Contries Options from Country Model
     * @return \Illuminate\Support\Collection
     */
    public function getCountriesOptions() {
           
        $options = Collection::make([0 => 'Please Select'] + Country::getCountriesOptions()->toArray());
        return $options;
    }
}