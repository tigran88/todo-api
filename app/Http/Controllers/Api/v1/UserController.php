<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Repositories\User\UserRepositoryEloquent as User;

class UserController extends ApiController
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
        $users = $this->user->paginate();

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        if($this->user->create()) {
            return $this->respondWithMessage('User created', 201);
        }

        return $this->respondError('Failed to create', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->user->getById($id);

        if( ! $user) {
            return $this->respondNotFound('User not found');
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->getById($id);

        if( ! $user) {
            return $this->respondNotFound('User not found');
        }

        if($this->user->update($id)) {
            return $this->respondWithMessage('User updated');
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
        $user = $this->user->getById($id);

        if( ! $user) {
            return $this->respondNotFound('User not found');
        }

        if($this->user->delete($id)) {
            return $this->respondWithMessage('User deleted');
        }

        return $this->respondError('Failed to delete', 500);
    }
}
