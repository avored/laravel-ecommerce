<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\State;
use AvoRed\Ecommerce\Http\Requests\StateRequest;
use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Ecommerce\Models\Database\Country;

class StateController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(State::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->column('code')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.state.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-state-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.state.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-state-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });


        return view('avored-ecommerce::admin.state.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryOptions = [null => 'Please Select'] + Country::all()->pluck('name', 'id')->toArray();
        return view('avored-ecommerce::admin.state.create')->with('countryOptions', $countryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\StateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        State::create($request->all());

        return redirect()->route('admin.state.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countryOptions = [null => 'Please Select'] + Country::all()->pluck('name', 'id')->toArray();
        $state = State::findorfail($id);

        return view('avored-ecommerce::admin.state.edit')
            ->with('model', $state)
            ->with('countryOptions', $countryOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\StateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, $id)
    {
        $state = State::findorfail($id);
        $state->update($request->all());

        return redirect()->route('admin.state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminte\Http\Response
     */
    public function destroy($id)
    {
        State::destroy($id);
        return redirect()->route('admin.state.index');
    }
}
