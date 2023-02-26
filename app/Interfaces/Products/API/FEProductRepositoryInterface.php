<?php

namespace App\Interfaces\Products\API;

interface FEProductRepositoryInterface
{
    public function findAll(array $params);
    public function findByCodeAndId($code, $id);
}
