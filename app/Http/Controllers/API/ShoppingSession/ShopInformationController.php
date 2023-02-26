<?php

namespace App\Http\Controllers\API\ShoppingSession;

use App\Http\Controllers\ApiController as BaseController;
use App\Libs\HttpStatusCode;
use App\Services\Shop\GetShopInformationService;

class ShopInformationController extends BaseController
{
    public function getOwnerInformation($shopcode, GetShopInformationService $shop_info){
        $shopinfo = $shop_info->getInfoByCode($shopcode);

        $data = $shopinfo['data'];
        $message = $shopinfo['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_200_OK)
            ->respond($data, $message);
    }

    public function isExists($shopcode, GetShopInformationService $shop_info){
        $shopinfo = $shop_info->isExists($shopcode);

        $data = $shopinfo['data'];
        $message = $shopinfo['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_200_OK)
            ->respond($data, $message);
    }
}
