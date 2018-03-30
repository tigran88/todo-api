<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\ProjectRequest;
use App\Repositories\Project\ProjectRepositoryEloquent as Project;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;

class ProjectController extends ApiController
{
    /**
     * @var Project
     */
    private $project;

    /**
     * ProjectController constructor.
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ProjectCollection
     */
    public function index()
    {
        $projects = $this->project->paginate();

        return new ProjectCollection($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectRequest $request)
    {
        if($this->project->create()) {
            return $this->respondWithMessage('Project created');
        }

        return $this->respondError('Failed to create', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $project = $this->project->getById($id);

        if( ! $project) {
            return $this->respondNotFound('Project not found');
        }

        return $this->respondWithMessage(new ProjectResource($project));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = $this->project->getById($id);

        if( ! $project) {
            return $this->respondNotFound('Project not found');
        }

        if($this->project->update($id)) {
            return $this->respondWithMessage('Project updated');
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
        $project = $this->project->getById($id);

        if( ! $project) {
            return $this->respondNotFound('Project not found');
        }

        if($this->project->delete($id)) {
            return $this->respondWithMessage('Project deleted');
        }

        return $this->respondError('Failed to delete', 500);
    }
}
