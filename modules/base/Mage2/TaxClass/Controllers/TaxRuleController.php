<?php
namespace Mage2\TaxClass\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\TaxClass\Models\TaxRule;

class TaxRuleController extends Controller
{

    public function getTaxAmount(Request $request) {

        $taxRules = TaxRule::orderBy('priority','ASC')->get();
        $fieldName = $request->get('name');
        $fieldValue = $request->get('value');


        foreach ($taxRules as  $taxRule) {
            if($taxRule->$fieldName == $fieldValue || $taxRule->$fieldName == "*") {
                break;
            }
        }

        $cartItems = Session::get('cart');

        $taxAmount = 0;

        foreach($cartItems as $item) {

            $taxAmount += ($item['price'] * $taxRule->percentage ) / 100;
        }

        return $request->all();
    }
}
