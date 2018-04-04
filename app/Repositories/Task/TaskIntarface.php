<?php

namespace App\Repositories\Task;

interface TaskIntarface
{
    public function getById($id);
    public function paginate();
    public function create();
    public function update($id);
    public function delete($id);
}