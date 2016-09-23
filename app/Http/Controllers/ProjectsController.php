<?php

namespace App\Http\Controllers;

use Dingo\Api\Http\Response;
use Illuminate\Http\Request;

use App\Data\Models\Project;

class ProjectsController extends Controller
{
    /**
     * The controller's model
     *
     * @var Project
     */
    protected $model;

    /**
     * The constructor for the controller
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $archived = $request->input('archived', false);
        $collection = $this->model->getPaginated($request->get('per_page', 10), $archived);
        return $this->response()->array($collection->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Validate the input
        $item = $this->model->create($request->all());

        return $this->response()
            ->array($item->toArray())
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->model->getByKey(get_request_id());

        return $this->response()->array($item->toArray());
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
        // TODO: Validate the input
        $item = $this->model->getByKey(get_request_id())->fill($request->all());
        $item->save();

        return $this->response()->array($item->toArray());
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->getByKey(get_request_id())->delete();

        return $this->response->noContent();
    }
}
