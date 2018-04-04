<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\TaskRequest;
use App\Repositories\Task\TaskRepositoryEloquent as Task;
use App\Http\Resources\Task as TaskResourece;
use App\Http\Resources\TaskCollection;

class TaskController extends ApiController
{
    /**
     * @var Task
     */
    protected $model;

    /**
     * TaskController constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return TaskCollection
     */
    public function index()
    {
        $tasks = $this->task->paginate();

        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        if($this->task->create()) {
            return $this->respondWithMessage('Task created', 201);
        }

        return $this->respondError('Failed to create', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return TaskResourece|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $task = $this->task->getById($id);

        if( ! $task) {
            return $this->respondNotFound('Task not found');
        }

        return new TaskResourece($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $this->task->getById($id);

        if( ! $task) {
            return $this->respondNotFound('Task not found');
        }

        if($this->task->update($id)) {
            return $this->respondWithMessage('Task updated');
        }

        return $this->respondError('Failed to update', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $task = $this->task->getById($id);

        if( ! $task) {
            return $this->respondNotFound('Task not found');
        }

        if($this->task->delete($id)) {
            return $this->respondWithMessage('Task Deleted');
        }

        return $this->respondError('Failed to update', 500);
    }
}
