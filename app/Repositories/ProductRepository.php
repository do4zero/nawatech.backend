<?php

namespace App\Repositories;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    function __construct(Product $product) {
        $this->product = $product;
    }

    public function findAll($params = array())
    {
        $search = $params['search'];
        $perPageSize = $params['per_page_size'] ?? 2;
        unset($params['search']);
        $conditions = $params;

        $products = $this->product
                        ->where('name','like','%'.$search.'%')
                        ->where($conditions)
                        ->orderBy('id','DESC')
                        ->paginate($perPageSize);

        return $products;
    }

    public function findById($id){
        return $this->product->findOrFail($id)->toArray();
    }

    public function delete($id){
        return $this->product->find($id)->delete();
    }

    public function create(array $productData){
        return $this->product->create($productData);
    }

    public function update($id, array $productData){
        return $this->product->where(['id' => $id])->update($productData);
    }
}
