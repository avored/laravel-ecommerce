<?php
namespace AvoRed\Subscribe\Http\Controllers\Admin;

use AvoRed\Framework\System\Controllers\Controller;
use AvoRed\Subscribe\DataGrid\SubscribeDataGrid;
use AvoRed\Subscribe\Http\Requests\SubscribeRequest;
use AvoRed\Subscribe\Models\Contracts\SubscribeInterface;
use AvoRed\Subscribe\Models\Database\Subscribe;

class SubscribeController extends Controller
{
     /**
     *
     * @var \AvoRed\Subscribe\Models\Repository\SubscribeRepository;
     */
    protected $repository;

    public function __construct(SubscribeInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the Subscribe.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new SubscribeDataGrid($this->repository->query());

        return view('avored-subscribe::subscribe.index')
                    ->with('dataGrid', $grid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-subscribe::subscribe.create');
    }

    /**
     * Store a newly created subscribe in database.
     *
     * @param \AvoRed\Subscribe\Http\Requests\SubscribeRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {
        $request->merge(['email' => $request->get('subscribe_email')]);
        $this->repository->create($request->all());

        return redirect()->route('admin.subscribe.index');
    }

    /**
     * Show the form for editing the specified subscribe.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        //This is just for the Form to populate values
        $subscribe->subscribe_email = $subscribe->email;

        return view('avored-subscribe::subscribe.edit')->with('model', $subscribe);
    }

    /**
     * Update the specified subscribe in database.
     *
     * @param \AvoRed\Subscribe\Http\Requests\SubscribeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SubscribeRequest $request, Subscribe $subscribe)
    {
        $request->merge(['email' => $request->get('subscribe_email')]);
       
        $subscribe->update($request->all());

        return redirect()->route('admin.subscribe.index');
    }

    /**
     * Remove the specified subscribe from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return redirect()->route('admin.subscribe.index');
    }


    /**
     * Show the application dashboard.
     * @param \AvoRed\Subscribe\Http\Requests\SubscribeRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        return view('avored-subscribe::subscribe.show')->with('subscribe', $subscribe);
    }
}
