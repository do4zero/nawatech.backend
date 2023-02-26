<?php

namespace App\Services\Shop;

use App\Interfaces\Shop\ShopInformationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GetShopInformationService
{
    private ShopInformationRepositoryInterface $shopInformation;

    function __construct(ShopInformationRepositoryInterface $shopInformation) {
        $this->shopInformation = $shopInformation;
    }

    /**
     * Get Shop Information By Auth Admin User
     */
    public function getInfoByAuth()
    {
        $userdata = auth()->user();
        $userid = $userdata->id;

        try {
            $shop = $this->shopInformation->findByUserId($userid);

            $data = [
                'seller' => [
                    'id' => $userdata->id,
                    'fullname' => $userdata->name,
                    'email' => $userdata->email,
                    'phone' => $shop->phone,
                    'alamat' => $shop->alamat
                ],
                'shop' => [
                    'id' => $shop->id,
                    'code' => $shop->shop_code,
                    'alamat' => $shop->address,
                    'nama_toko' => $shop->name,
                    'no_telpon' => $shop->phone,
                ]
            ];

        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'reason' => $th->getMessage(),
                'message' => 'Products failed to loaded'
            ];
        }

        return [
            'data' => $data,
            'message' => 'Products successfully loaded'
        ];
    }

    public function getInfoByCode($shopcode)
    {
        try {
            $shop = $this->shopInformation->findByCode($shopcode);
            $userdata = $this->shopInformation->findUser($shop->user_id);

            $data = [
                'seller' => [
                    'id' => $userdata->id,
                    'fullname' => $userdata->name,
                    'email' => $userdata->email,
                    'phone' => $shop->phone,
                    'alamat' => $shop->alamat
                ],
                'shop' => [
                    'id' => $shop->id,
                    'code' => $shop->shop_code,
                    'alamat' => $shop->address,
                    'nama_toko' => $shop->name,
                    'no_telpon' => $shop->phone,
                ]
            ];

        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'reason' => $th->getMessage(),
                'message' => 'Products failed to loaded'
            ];
        }

        return [
            'data' => $data,
            'message' => 'Products successfully loaded'
        ];
    }

    public function isExists($shopcode)
    {
        try {
            $shop = $this->shopInformation->isExists($shopcode);

            $data = [
                'exists' =>  $shop > 0 ? true : false
            ];

        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'reason' => $th->getMessage(),
                'message' => 'Products failed to loaded'
            ];
        }

        return [
            'data' => $data,
            'message' => 'Products successfully loaded'
        ];
    }
}
