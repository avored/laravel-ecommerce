<?php
namespace Mage2\User\Models;

use Mage2\Framework\System\Models\BaseModel;
use Mage2\TaxClass\Models\Country;
use Mage2\System\Models\Configuration;

class Address extends BaseModel
{
    protected $fillable = [
                    'user_id',
                    'type',
                    'first_name',
                    'last_name',
                    'address1',
                    'address2',
                    'postcode',
                    'city',
                    'state',
                    'country_id',
                    'phone',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    public function getCountryIdAttribute() {
        
        if(isset($this->attributes['country_id']) && $this->attributes['country_id'] > 0) {
            return $this->attributes['country_id'];
        }
        
        $defaultCountry = Configuration::getConfiguration('mage2_address_default_country');
        
        if(isset($defaultCountry)) {
            return $defaultCountry;
        }
        
        return "";
    }
}
