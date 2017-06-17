<?php
namespace Mage2\Framework\DataGrid;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Mage2\Framework\DataGrid\Columns\TextColumn;
use Mage2\Framework\DataGrid\Columns\LinkColumn;

class DataGridManager
{

    /**
     * Database table model
     *
     * @var \Illuminate\Http\Request
     */

    public $request;


    /**
     * Database table model
     *
     * @var \Illuminate\Support\Collection
     */
    public $data;
    /**
     * Database table model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;
    /**
     * Database table model
     *
     * @var \Illuminate\Support\Collection
     */
    public $columns = NULL;
    /**
     * Database table model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $paginate = 10;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function dataTableData($model)
    {

        $count = $model->all()->count();

        $columns = $this->request->get('columns');
        $orders = $this->request->get('order');

        $order = $orders[0];

        $records = $model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');


        $records->skip($noOfSkipRecord)->take($noOfRecord);


        $data = [
            "data" => $records->get(),
            "draw" => $this->request->get('draw'),
            "recordsTotal" => $count,
            "recordsFiltered" => $count
        ];

        return JsonResponse::create($data);


    }

    /**
     *
     * @param type $model
     * @return \Mage2\Framework\DataGrid\DataGrid
     *
     */
    public static function make($model)
    {
        $instance = new static;
        $instance->model = $model;
        $instance->data = $instance->model->paginate($instance->paginate);

        return $instance;
    }

    public function addColumn($column)
    {
        if (NULL === $this->columns) {
            $this->columns = Collection::make([]);
        }
        $this->columns->push($column);
        return $this;
    }

    public function addLink($row = false)
    {
        dd(is_callable($row));

        //if($row && is_callable($row))
        //return $return($label, $row);
    }

    public static function textColumn($identifier, $label)
    {
        return new TextColumn($identifier, $label);

    }


    public static function linkColumn($identifier, $label, $callback)
    {
        return new LinkColumn($identifier, $label, $callback);
    }


    public function paginate($recordPerPage = 10)
    {
        $this->data = $this->model->paginate($recordPerPage);

        return $this;
    }

    public function render()
    {
        return view('datagrid::grid')->with('dataGrid', $this);
    }
}