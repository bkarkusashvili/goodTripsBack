<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $headers = [ 'id' => 'ID' ];

    protected $indexData;

    protected $createData;

    public function __construct() {

        $this->model = new $this->model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->headers['actions'] = 'Actions';
        $this->indexData['headers'] = $this->headers;
        $this->indexData['model'] = $this->modelName;

        $items = $this->model::get();

        $this->indexData['rows'] = $items;

        return view('shared.index', ['data' => $this->indexData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->createData['model'] = $this->modelName;
        $this->createData['main'] = isset($this->mainInputs) ? $this->mainInputs : [];
        $this->createData['aside'] = isset($this->asideInputs) ? $this->asideInputs : [];

        return view('shared.create', ['data' => $this->createData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate($this->createValidators);

        $validData = $this->beforeStore($validData);

        $this->model::create($validData);

        return redirect()->route($this->modelName.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->createData['model'] = $this->modelName;
        $this->createData['main'] = isset($this->mainInputs) ? $this->mainInputs : [];
        $this->createData['aside'] = isset($this->asideInputs) ? $this->asideInputs : [];

        $item = $this->model::select($this->select)->findOrFail($id);

        $this->createData['response'] = $item;

        $this->createData = $this->updateCreateData($this->createData);

        return view('shared.edit', ['data' => $this->createData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validData = $request->validate($this->updateValidators);

        $validData = $this->beforeUpdate($validData);

        $this->model::findOrFail($id)->update($validData);

        flash('მონაცმები განახლდა')->important();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);

        if ($this->beforeDestroy($item)) {
            flash('მონაცემი წაიშალა')->important();
            $this->model::destroy($id);
        } else {
            flash('წაშლა შეუძლებელია')->error()->important();
        }

        return redirect()->back();
    }

    public function updateCreateData($data) { return $data; }

    public function beforeStore($data) { return $data; }

    public function beforeUpdate($data) { return $data; }

    public function beforeDestroy($data) { return true; }

}
