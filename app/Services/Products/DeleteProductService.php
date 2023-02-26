<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteProductService
{
    private ProductRepositoryInterface $productRepository;

    function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function execute($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->delete($id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'reason' => $th->getMessage(),
                'message' => 'Product failed to delete'
            ];
        }

        return [
            'status' => true,
            'product' => $product,
            'message' => 'Product successfully delete'
        ];
    }
}
