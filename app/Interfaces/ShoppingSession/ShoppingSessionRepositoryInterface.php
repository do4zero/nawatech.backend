<?php

namespace App\Interfaces\ShoppingSession;

interface ShoppingSessionRepositoryInterface
{
    public function findById($id);
    public function create(array $sessionData);
}
