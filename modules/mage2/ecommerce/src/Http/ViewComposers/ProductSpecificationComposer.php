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
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Attribute\ViewComposers;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Mage2\Framework\Tabs\Facades\Tabs;

class ProductSpecificationComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        //Tabs::add('product-attribute')
        //    ->setType('product-view')
        //    ->setLabel('Specification')
        //    ->setViewpath('attribute.product-specification-tab');


        //$productAttributes = Collection::make(['' => 'Please Select'])->union(ProductAttribute::all()->pluck('title', 'id'));

        //$productAttributes  = [];//ProductAttribute::whereUseAs('SPECIFICATION')->get();

        //$view->with('productAttributes', $productAttributes)
            ;
    }

}
