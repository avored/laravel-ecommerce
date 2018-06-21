<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Ecommerce\Models\Database\Role;
use Illuminate\View\View;
use AvoRed\Ecommerce\Models\Database\SiteCurrency;
use AvoRed\Ecommerce\Models\Database\Country;
use Illuminate\Support\Collection;

class SiteCurrencyFieldsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $countries = Country::all();
        $options = Collection::make();
        foreach ($countries as $country) {
            $options->put($country->currency_code,['id' => $country->currency_code,'name' => $country->currency_code] );
        }
        $statusOptions = Collection::make([['id' => 'ENABLED','name' => 'Enabled'],['id' => 'DISABLED','name' => 'Disabled']]);
       
        $view->with('codeOptions', $options)
                    ->with('statusOptions',$statusOptions);
    }
}
