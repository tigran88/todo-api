<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;

class UserRepositoryEloquent extends EloquentRepository implements UserInterface
{
    /**
     * @var User
     */
    protected $model;

    function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create()
    {
        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->password = request('password');

        return $user->save();
    }

    public function update($id)
    {
        $user = User::find($id);

        if(request()->has('name')) {
            $user->name = request('name');
        }

        if(request()->has('email')) {
            $user->email = request('email');
        }

        if(request()->has('password')) {
            $user->password = request('password');
        }

        return $user->save();
    }

    public function delete($id)
    {
        $user = User::find($id);

        return $user->delete();
    }

}