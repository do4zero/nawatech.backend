<?php

namespace App\Repositories\API;

use App\Interfaces\Products\API\FEShopRepositoryInterface;
use App\Models\Shop;

class FEShopRepository implements FEShopRepositoryInterface
{
    protected $shop;

    function __construct(Shop $shop) {
        $this->shop = $shop;
    }

    public function findByCode($code = '')
    {
        $shop = $this->shop
                        ->where('shop_code',$code)
                        ->first();

        return $shop;
    }

    public function isExists($params = array()){
        $shop = $this->shop
                    ->where($params)
                    ->count();
        return $shop;
    }
}
