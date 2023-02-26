<?php

namespace App\Repositories\API;

use App\Interfaces\Products\API\FEProductRepositoryInterface;
use App\Models\Product;


class FEProductRepository implements FEProductRepositoryInterface
{
    protected $product;

    function __construct(Product $product) {
        $this->product = $product;
    }

    public function findAll($params = array(), $fields = array())
    {
        $search = $params['search'] ?? '';
        $perPageSize = $params['per_page_size'] ?? 10;
        $conditions = $params;
        unset($conditions['search']);

        $products = $this->product;

        if(!empty($fields)) $products = $products->select($fields);

        $products = $products
                        ->where('name','like','%'.$search.'%')
                        ->where($conditions)
                        ->orderBy('id','DESC')
                        ->paginate($perPageSize);

        return $products;
    }

    public function findByCodeAndId($params, $fields = array()){
        $product = $this->product;
        if(!empty($fields)) $product = $product->select($fields);
        $product = $product->where($params)->first()->toArray();

        return $product;
    }
}
