<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\CommentRequest;
use App\Repositories\Comment\CommentRepositoryEloquent as Comment;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\CommentCollection;

class CommentController extends ApiController
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * CommentController constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CommentCollection
     */
    public function index()
    {
        $comments = $this->comment->paginate();

        return new CommentCollection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request)
    {
        if($this->comment->create()) {
            return $this->respondWithMessage('Comment created');
        }

        return $this->respondError('Failed to create', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return CommentResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $comment = $this->comment->getById($id);

        if( ! $comment) {
            return $this->respondNotFound('Comment not found');
        }

        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = $this->comment->getById($id);

        if( ! $comment) {
            return $this->respondNotFound('Comment not found');
        }

        if($this->comment->update($id)) {
            return $this->respondWithMessage('Comment updated');
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
        $comment = $this->comment->getById($id);

        if( ! $comment) {
            return $this->respondNotFound('Comment not found');
        }

        if($this->comment->delete($id)) {
            return $this->respondWithMessage('Comment deleted');
        }

        return $this->respondError('Failed to delete');
    }
}
