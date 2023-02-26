<?php

namespace App\Services\Transaction\API;

use App\Libs\Helpers;
use App\Repositories\API\FEProductRepository;
use App\Repositories\API\FETransactionRepository;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    private FETransactionRepository $transactionRepository;
    private FEProductRepository $productRepository;

    function __construct(FETransactionRepository $transactionRepository, FEProductRepository $productRepository) {
        $this->transactionRepository = $transactionRepository;
        $this->productRepository = $productRepository;
    }

    public function findAll($searchTerm, $conditions = array(), $date_filter = array())
    {
        $data = $this->transactionRepository->list($searchTerm,$conditions,$date_filter);

        return [
            'status' => true,
            'data' => $data,
            'message' => 'History List Order data successfully loaded'
        ];
    }

    public function listHistory($sessionid)
    {
        $data = $this->transactionRepository->listOrder($sessionid);

        return [
            'status' => true,
            'data' => $data,
            'message' => 'History List Order data successfully loaded'
        ];
    }

    public function create($params = array())
    {
        DB::beginTransaction();
        try {
            $data = [
                'invoice_number' => Helpers::invoiceNumber(),
                'total_qty' => $params['total_qty'],
                'total_amount' => $params['total_amount'],
                'name' => $params['name'],
                'email' => $params['email'],
                'phone' => $params['phone'],
                'address' => $params['address'],
                'session_id' => $params['session_id'],
                'payment_id' => $params['payment_id'],
                'shop_id' => $params['shop_id'],
            ];

            $transaction = $this->transactionRepository->create($data);

            if($transaction)
            {
                $items = $params['items'];
                $detail = [];
                $i = 0;
                foreach($items as $item){
                    $product = $this->productRepository->findByCodeAndId(['id' => $item['produk_id']]);
                    $detail[$i]['transaction_id'] = $transaction->id;
                    $detail[$i]['product_id'] = $item['produk_id'];
                    $detail[$i]['product_name'] = $product['name'];
                    $detail[$i]['price'] = $product['price'];
                    $detail[$i]['qty'] = $item['qty'];
                    $detail[$i]['amount'] = ((int) $product['price'] * (int)$item['qty']);
                    $detail[$i]['created_at'] = date('Y-m-d H:i:s');
                    $detail[$i]['updated_at'] = date('Y-m-d H:i:s');
                    $i++;
                }

                $this->transactionRepository->createDetail($detail);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'reason' => $th->getMessage(),
                'data' => null,
                'message' =>  $th->getMessage().' Transaction failed to '. (empty($id) ? ' create' : 'update')
            ];
        }

        return [
            'status' => true,
            'data' => $transaction,
            'message' => 'Transaction successfully '. (empty($id) ?  ' created' : 'updated')
        ];
    }

    public function getTrxDetail($invoicenumber)
    {
        $data = $this->transactionRepository->trxDetail($invoicenumber);

        return [
            'status' => true,
            'data' => $data,
            'message' => 'Transaction data successfully loaded'
        ];
    }

    public function totalOrder($date_filter = array(), $conditions = array()){
        $data = $this->transactionRepository->totalOrder($date_filter, $conditions);

        return [
            'status' => true,
            'data' => $data,
            'message' => 'Total List Order data successfully loaded'
        ];
    }
}
