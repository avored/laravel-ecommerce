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
namespace Mage2\Ecommerce\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseModel extends Model
{
    public static function  findorfail($id, array $columns = array('*'))
    {
        $model = new static();

        //$cacheKey = get_class($model) . "_" . $id;
        //if (Cache::has($cacheKey)) {
        //    return Cache::get($cacheKey);
        //}

        try {
            $row = call_user_func_array([static::query(), 'findorfail'], [$id, $columns]);
        //    Cache::put($cacheKey, $row, $minute = 100);
            return $row;
        } catch (ModelNotFoundException $e) {
            throw with(new TenantModelNotFoundException())->setModel(get_called_class());
        }
    }

    /*
     *
     * Not sure if i can implement this or not?
     * problem:: how to remove cache ???
    public static function  where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $model = new static();


        $cacheKey = get_class($model) . "_" . $column . "_" . $operator . "_" . $value . "_" . $boolean;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        return parent::where($column, $operator, $value, $boolean);
    }
    */

    /**
    public static function  all($columns = ['*'])
    {
        $model = new static;

        $cacheKey = get_class($model) . "_all" ;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $rows = $model->all($columns);
        //$rows = parent::all($columns);

        Cache::put($cacheKey, $rows, $minute = 100);
        return $rows;
    }
     * 
    
     */

    
    public static function paginate($perPage = null, 
                                    array $columns = array('*'), 
                                    $pageName = 'page', 
                                    $page = null)
    {
        $model = new static();

        //$cacheKey = get_class($model) . "_paginate" ;
        //if (Cache::has($cacheKey)) {
        //    return Cache::get($cacheKey);
        //}
        $rows = call_user_func_array([static::query(), 'paginate'], [$perPage , $columns, $pageName , $page]);

        //Cache::put($cacheKey, $rows, $minute = 100);
        return $rows;

    }

    public static function create(array $attributes = [])
    {
        //$model = new static;
        //$model->forgetCommonQueryCache();


        $row = call_user_func_array([static::query(), 'create'], [$attributes]);

        return $row;
    }


    public function update(array $attributes = [], array $options = [])
    {
        //$cacheKey = get_class($this) . "_" . $this->attributes['id'];
        //Cache::forget($cacheKey);
        //$this->forgetCommonQueryCache();

        return parent::update($attributes, $options);
    }


    public function delete() {

        //$cacheKey = get_class($this) . "_" . $this->attributes['id'];
        //Cache::forget($cacheKey);

        //$this->forgetCommonQueryCache();
        return parent::delete();
    }

    public function forgetCommonQueryCache() {

        //$cacheKey = get_class($this) . "_all";
        //Cache::forget($cacheKey);


        //$cacheKey = get_class($this) . "_paginate";
        //Cache::forget($cacheKey);

    }
}

