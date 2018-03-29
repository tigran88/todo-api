<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function getById($id);
    public function paginate();
    public function create();
    public function update($id);
    public function delete($id);
}