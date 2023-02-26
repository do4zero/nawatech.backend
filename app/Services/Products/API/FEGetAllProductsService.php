<?php

namespace App\Services\Products\API;

use App\Repositories\API\FEProductRepository;
use Illuminate\Support\Facades\DB;

class FEGetAllProductsService
{
    private FEProductRepository $productRepository;

    function __construct(FEProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function display($params = array())
    {
        try {
            $products = $this->productRepository->findAll($params, [
                'id',
                'name',
                'price',
                'stok',
                'image',
                'created_at'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'pagination' => $th,
                'reason' => $th->getMessage(),
                'message' => 'Products failed to loaded'
            ];
        }

        return [
            'data' => $products->items(),
            'pagination' => [
                'totalData' => $products->total(),
                'perPage' => $products->perPage(),
                'currentPage' => $products->currentPage(),
            ],
            'message' => 'Products successfully loaded'
        ];
    }
}
