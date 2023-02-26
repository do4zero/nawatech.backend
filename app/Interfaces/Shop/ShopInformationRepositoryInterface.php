<?php

namespace App\Interfaces\Shop;

interface ShopInformationRepositoryInterface
{
    public function findByUserId($userid);
    public function findByCode($shopcode);
    public function findUser($shopcode);
    public function isExists($shopcode);
}
