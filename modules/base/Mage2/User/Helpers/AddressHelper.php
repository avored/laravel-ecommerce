<?php
namespace Mage2\User\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Mage2\TaxClass\Models\Country;

class AddressHelper
{
    /**
     * Get the list of the Contries Options from Country Model.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountriesOptions()
    {
        $options = Collection::make([0 => 'Please Select'] + Country::getCountriesOptions()->toArray());

        return $options;
    }
}
