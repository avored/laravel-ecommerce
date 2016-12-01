<?php
namespace Mage2\User\Controllers\Admin;

use Mage2\User\Helpers\AddressHelper;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;

class ConfigurationController extends AdminController
{
    /**
     * Address Helper Instance.
     *
     * @var \Mage2\User\Helpers\AddressHelper
     */
    public $addressHelper;

    public function __construct(AddressHelper $addressHelper)
    {
        parent::__construct();
        $this->addressHelper = $addressHelper;
    }

    /**
     * Display a listing of the Catalog Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfiguration()
    {
        $countries = $this->addressHelper->getCountriesOptions();
        $configurations = Configuration::all()->pluck('configuration_value', 'configuration_key');

    
        return view('admin.address.configuration.index')
                ->with('configurations', $configurations)
                ->with('countries', $countries);
    }
}
