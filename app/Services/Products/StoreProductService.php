<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
    private ProductRepositoryInterface $productRepository;

    function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function save($params = array(), $id = '')
    {
        DB::beginTransaction();
        try {
            if(!empty($params['image'])){
                if(is_object($params['image'])):
                    $params['image'] = $params['image']->storePublicly('image');
                else:
                    unset($params['image']);
                endif;
            }

            if(!empty($id)){
                $product = $this->productRepository->update($id, $params);
            }else{
                $product = $this->productRepository->create($params);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'reason' => $th->getMessage(),
                'message' =>  $th->getMessage().'Product failed to '. (empty($id) ? ' create' : 'update')
            ];
        }

        return [
            'status' => true,
            'product' => $product,
            'message' => 'Product successfully '. (empty($id) ?  ' created' : 'updated')
        ];
    }
}
