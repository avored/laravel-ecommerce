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
namespace Mage2\Ecommerce\Permission;

use Illuminate\Support\Collection;

class Manager {
    
    /**
     * Collect all the Permissions from all the modules
     * 
     * @var \Illuminate\Support\Collection
     */
    protected $permissions;
    
    public function __construct() {
        $this->permissions = Collection::make([]);
    }

    public function all() {

        //dd($this->permissions);
        return $this->permissions;
    }
    /**
     * Add Permission Array into Collection
     * 
     * @param array $item
     * @return \Mage2\Ecommerce\Permission\Manager
     */
    public function add($item) {
        //$this->permissions->push($item);
        return $this;
    }

    /**
     * Get Permission Collection if exists or Return Empty Collection
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */

    public function get($key) {

        if($this->permissions->has($key)) {
            return $this->permissions->get($key);
        }

        return $collection = Collection::make([]);

    }
    /**
     * Get Permission Collection if exists or Return Empty Collection
     *
     * @param array $item
     * @return \Illuminate\Support\Collection
     */

    public function set($key , $permissionCollection) {

        //dd($permissionCollection);
        $this->permissions->put($key, $permissionCollection);
        return $this;

    }

}