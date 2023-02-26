<?php

namespace App\Repositories;

use App\Interfaces\Shop\ShopInformationRepositoryInterface;
use App\Models\Shop;
use App\Models\User;

class ShopInformationRepository implements ShopInformationRepositoryInterface
{
    protected $shop;
    protected $user;

    function __construct(Shop $shop, User $user) {
        $this->shop = $shop;
        $this->user = $user;
    }

    public function findByUserId($id)
    {
        return $this->shop->where(['user_id' => $id])->first();
    }

    public function findByCode($code)
    {
        return $this->shop->where(['shop_code' => $code])->first();
    }

    public function findUser($id){
        return $this->user->where(['id' => $id])->first();
    }

    public function isExists($code)
    {
        return $this->shop->where(['shop_code' => $code])->count();
    }
}
