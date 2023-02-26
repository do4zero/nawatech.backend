<?php

namespace App\Services\Products\API;

use App\Repositories\API\FEProductRepository;
use Illuminate\Support\Facades\DB;

class FEGetOneProductService
{
    private FEProductRepository $productRepository;

    function __construct(FEProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function display($params = array())
    {
        try {
            $products = $this->productRepository->findByCodeAndId($params, [
                'id',
                'name',
                'description',
                'price',
                'stok',
                'image',
                'created_at',
                'updated_at'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'reason' => $th->getMessage(),
                'message' => 'Product failed to loaded'
            ];
        }

        return [
            'data' => $products,
            'message' => 'Product successfully loaded'
        ];
    }
}
