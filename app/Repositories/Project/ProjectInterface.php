<?php

namespace App\Repositories\Project;

interface ProjectInterface
{
    public function getById($id);
    public function paginate();
    public function create();
    public function update($id);
    public function delete($id);
}