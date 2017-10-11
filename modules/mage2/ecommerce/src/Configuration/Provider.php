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
namespace Mage2\Ecommerce\Configuration;

use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Configuration\Facade as AdminConfiguration;

class Provider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    public function boot() {

        $this->addConfig();

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAdminConfiguration();
        $this->app->alias('configuration', 'Mage2\Ecommerce\Configuration\Manager');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        $this->app->singleton('configuration', function ($app) {
            return new Manager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['configuration', 'Mage2\Ecommerce\Configuration\Manager'];
    }

    public function addConfig() {

        $adminConfigurations[] = [
            'title' => 'Address Configuration',
            'description' => 'Set Default Country for Store',
            'edit_action' => 'admin.configuration.address',
        ];

        $adminConfigurations[] = [
            'title' => 'Order Configuration',
            'description' => 'Some Description for Order Modules',
            'edit_action' => 'admin.configuration.order',
            'sort_order' => 1
        ];

        $adminConfigurations[] = [
            'title' => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => 'admin.configuration.tax-class',
            'sort_order' => 3
        ];

        $adminConfigurations[] = [
            'title' => 'Catalog Configuration',
            'description' => 'Some Description for Catalog Modules',
            'edit_action' => 'admin.configuration.catalog',
            'sort_order' => 1
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }
}