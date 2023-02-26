<?php

namespace App\Interfaces\Products;

interface ProductRepositoryInterface
{
    public function findAll(array $params);
    public function findById($id);
    public function delete($id);
    public function create(array $productData);
    public function update($id, array $productData);
}
