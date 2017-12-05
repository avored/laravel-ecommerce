<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mage2\Ecommerce\Models\Database\TaxRule;
use Illuminate\Support\Facades\Response;

class TaxRuleController extends Controller
{

    public function getTaxAmount(Request $request)
    {

        $taxRules = TaxRule::orderBy('priority', 'ASC')->get();
        $fieldName = $request->get('name');
        $fieldValue = $request->get('value');

        $findRule = null;
        foreach ($taxRules as $taxRule) {
            if (strtolower($taxRule->$fieldName) == strtolower($fieldValue) ||
                strtolower($taxRule->$fieldName) == "*"
            ) {
                $findRule = $taxRule;
                break;
            }
        }

        if (null === $findRule) {
            return Response::json(['success' => false]);
        }
        $cartItems = Session::get('cart');

        $taxAmount = 0;

        foreach ($cartItems as $item) {

            $taxAmount += ($item['price'] * $taxRule->percentage) / 100;
        }

        return Response::json(['success' => true, 'tax_amount' => $taxAmount, 'tax_amount_text' => "$" . number_format($taxAmount, 2)]);
    }
}
