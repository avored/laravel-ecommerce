<?php
namespace AvoRed\Ecommerce\DataGrid;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use AvoRed\Ecommerce\DataGrid\Columns\TextColumn;
use AvoRed\Ecommerce\DataGrid\Columns\LinkColumn;

class Manager
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
    protected $pageItem = 10;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->columns = Collection::make([]);
    }

    public function model($model) {

        $this->model = $model;

        return $this;
    }

    public function column($identifier, $options = []) {
        $column = new TextColumn($identifier, $options);
        $this->columns->put($identifier, $column );

        return $this;
    }

    public function setPagination($item = 10) {
        $this->pageItem = $item;
    }

    public function render() {

        if(null !== $this->request->get('asc')) {
            $this->model->orderBy($this->request->get('asc'), 'asc');
        }
        if(null !== $this->request->get('desc')) {
            $this->model->orderBy($this->request->get('desc'), 'desc');
        }

        $this->data = $this->model->paginate($this->pageItem);

        return view('avored-ecommerce::datagrid.grid')->with('dataGrid', $this);
    }

    public function asc($identifier = "") {
        return (NULL !== $this->request->get('asc')  && $this->request->get('asc') == $identifier);
    }

    public function desc($identifier = "") {
        return (NULL !== $this->request->get('desc') && $this->request->get('desc') == $identifier);
    }

    public function linkColumn($identifier, $options , $callback) {

        $column = new LinkColumn($identifier,$options ,$callback);
        $this->columns->put($identifier, $column );

        return $this;
    }


    public function dataTableData($model) {

        $this->model = $model;
        return $this;
        /**
        $count = $model->get()->count();

        $columns = $this->request->get('columns');
        $orders = $this->request->get('order');

        $order = $orders[0];

        $records = $model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $data = [
                "data" => $records->get(),
                "draw" =>  $this->request->get('draw'),
                "recordsTotal"=> $count,
                "recordsFiltered" => $count
                ];

         */


        //return JsonResponse::create($data);
    }


    /**
     *
     *
     * @return static
     *
     */
    public function get()
    {

        $count = $this->model->get()->count();

        $columns = $this->request->get('columns');


        $orders = $this->request->get('order');


        $order = $orders[0];

        $records = $this->model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $allRecords = $records->get();

        if(isset($this->columns) && $this->columns->count() > 0) {

            $jsonRecords = Collection::make([]);

            foreach ($allRecords as $i => $singleRecord) {
                foreach ($this->columns as $key => $columnData) {

                    if (is_callable($columnData)) {
                        $columnValue = $columnData($singleRecord);
                    } else {
                        $columnValue = $columnData;
                    }

                    $singleRecord->setAttribute($key, $columnValue);
                }

                $jsonRecords->put($i, $singleRecord);
            }
        }




        $data = [
            "data" => (isset($jsonRecords)) ? $jsonRecords : $allRecords,
            "draw" =>  $this->request->get('draw'),
            "recordsTotal"=> $count,
            "recordsFiltered" => $count
        ];

        return JsonResponse::create($data);

    }

    public function addColumn($columnKey , $data) {

        if(NULL === $this->columns) {
            $this->columns = Collection::make([]);
        }
        $this->columns->put($columnKey , $data);
        return $this;
    }
}