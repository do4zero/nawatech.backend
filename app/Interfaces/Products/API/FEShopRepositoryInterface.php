<?php

namespace App\Interfaces\Products\API;

interface FEShopRepositoryInterface
{
    public function findByCode($code);
    public function isExists(array $params);
}
