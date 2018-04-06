<?php

namespace App\Repositories\Comment;

use App\Repositories\EloquentRepository;
use App\Models\Comment;

class CommentRepositoryEloquent extends EloquentRepository implements CommentInterface
{
    protected $model;

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function create()
    {
        $comment = new Comment;

        $comment->text = request('text');
        $comment->task_id = request('task_id');
        $comment->user_id = request('user_id');

        return $comment->save();
    }

    public function update($id)
    {
        $comment = Comment::find($id);

        if(request()->has('text')) {
            $comment->text = request('text');
        }

        if(request()->has('task_id')) {
            $comment->task_id = request('task_id');
        }

        if(request()->has('user_id')) {
            $comment->user_id = request('user_id');
        }

        return $comment->save();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        return $comment->delete();
    }
}