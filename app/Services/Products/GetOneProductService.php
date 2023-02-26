<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductRepositoryInterface;

class GetOneProductService
{
    private ProductRepositoryInterface $productRepository;

    function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function display($id)
    {
        return $this->productRepository->findById($id);
    }
}
