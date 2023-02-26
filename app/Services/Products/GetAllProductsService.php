<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductRepositoryInterface;

class GetAllProductsService
{
    private ProductRepositoryInterface $productRepository;

    function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function display($params = array())
    {
        return $this->productRepository->findAll($params);
    }
}
