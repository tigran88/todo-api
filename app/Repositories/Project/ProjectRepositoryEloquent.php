<?php

namespace App\Repositories\Project;

use App\Repositories\EloquentRepository;
use App\Models\Project;

class ProjectRepositoryEloquent extends EloquentRepository implements ProjectInterface
{
    /**
     * @var Project
     */
    protected $model;

    function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function create()
    {
        $project = new Project;
        $project->name = request('name');

        return $project->save();
    }

    public function update($id)
    {
        $project = Project::find($id);

        if(request()->has('name')) {
            $project->name = request('name');
        }

        return $project->save();
    }

    public function delete($id)
    {
        $project = Project::find($id);

        return $project->delete();
    }
}