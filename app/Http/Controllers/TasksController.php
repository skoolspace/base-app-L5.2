<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;

use App\Data\Models\Task;

class TasksController extends Controller
{
    /**
     * The controller's model
     *
     * @var Task
     */
    protected $model;

    /**
     * The constructor for the controller
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->model->getByKey($id);

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
        $item = $this->model->update($request->all());

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
        $this->model->delete();

        return $this->response->noContent();
    }
}
