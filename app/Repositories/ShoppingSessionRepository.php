<?php

namespace App\Repositories;

use App\Interfaces\ShoppingSession\ShoppingSessionRepositoryInterface;
use App\Models\ShoppingSession;

class ShoppingSessionRepository implements ShoppingSessionRepositoryInterface
{
    protected $session;

    function __construct(ShoppingSession $session) {
        $this->session = $session;
    }

    public function findById($id)
    {

    }

    function create(array $sessionData)
    {
        return $this->session->create($sessionData);
    }
}
