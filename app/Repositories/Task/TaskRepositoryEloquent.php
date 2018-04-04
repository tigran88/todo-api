<?php

namespace App\Repositories\Task;

use App\Repositories\EloquentRepository;
use App\Models\Task;

class TaskRepositoryEloquent extends EloquentRepository implements TaskIntarface
{
    /**
     * @var Task
     */
    protected $model;

    function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function create() {
        $task = new Task;
        $task->name = request('name');
        $task->project_id = request('project_id');
        $task->user_id = request('user_id');

        return $task->save();
    }

    public function update($id)
    {
        $task = Task::find($id);

        if(request()->has('name')) {
            $task->name = request('name');
        }

        if(request()->has('project_id')) {
            $task->project_id = request('project_id');
        }

        return $task->save();
    }

    public function delete($id)
    {
        $task = Task::find($id);

        return $task->delete();
    }

}