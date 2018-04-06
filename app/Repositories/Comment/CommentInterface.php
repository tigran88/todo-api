<?php

namespace App\Repositories\Comment;

interface CommentInterface
{
    public function getById($id);
    public function paginate();
    public function create();
    public function update($id);
    public function delete($id);
}