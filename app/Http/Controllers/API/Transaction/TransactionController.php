<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\ApiController as BaseController;
use App\Http\Requests\API\Transaction\CreateTransactionRequest;
use App\Libs\HttpStatusCode;
use App\Services\Transaction\API\TransactionService;

class TransactionController extends BaseController
{
    /**
     * Create Payment Method
     */
    public function orderlistHistory($sessionid, TransactionService $transaction){
        $result = $transaction->listHistory($sessionid);

        $data = $result['data'];
        $message = $result['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_200_OK)
            ->respond($data, $message);
    }

    /**
     * Create Payment Method
     */
    public function create(CreateTransactionRequest $request, TransactionService $transaction){
        $result = $transaction->create($request->all());

        $data = $result['data'];
        $message = $result['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_201_CREATED)
            ->respond($data, $message);
    }

    /**
     * Create Payment Method
     */
    public function responsePayment($invoicenumber, TransactionService $transaction){
        $result = $transaction->getTrxDetail($invoicenumber);

        $data = $result['data'];
        $message = $result['message'];

        return $this
            ->responseCode(HttpStatusCode::HTTP_200_OK)
            ->respond($data, $message);
    }
}
