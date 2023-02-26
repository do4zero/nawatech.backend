<?php

namespace App\Repositories\API;

use App\Interfaces\Transaction\API\FETransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class FETransactionRepository implements FETransactionRepositoryInterface
{
    protected $transaction;
    protected $transactionDetail;

    function __construct(Transaction $transaction, TransactionDetail $transactionDetail) {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
    }

    public function list($searchTerm, $conditions = array(), $datefilter = array())
    {
        $order = $this->transaction;
        $order = $order->with(['items']);

        $order = $order->where(function($query) use($searchTerm){
            $query->where('invoice_number','like', '%'.$searchTerm.'%');
            $query->orWhere('name','like', '%'.$searchTerm.'%');
            $query->orWhere('email','like', '%'.$searchTerm.'%');
            $query->orWhere('phone','like', '%'.$searchTerm.'%');
            $query->orWhere('address','like', '%'.$searchTerm.  '%');
        });

        if(!empty($datefilter['from_date']) && empty($datefilter['to_date']))
            $order = $order->where('created_at', '>=', date('Y-m-d',strtotime($datefilter['from_date'])));

        if(empty($datefilter['from_date']) && !empty($datefilter['to_date']))
            $order = $order->where('created_at', '<=', date('Y-m-d',strtotime($datefilter['to_date'])));

        if(!empty($datefilter['from_date']) && !empty($datefilter['to_date']))
            $order = $order->whereBetween('created_at', [$datefilter['from_date'], $datefilter['to_date']]);

        $order = $order
                    ->where($conditions)
                    ->orderBy('created_at','DESC');

        return $order->paginate(10);
    }

    public function totalOrder($datefilter = array(), $conditions = array()){
        $order = $this->transaction;

        if(!empty($datefilter['from_date']) && empty($datefilter['to_date']))
            $order = $order->where('created_at', '>=', date('Y-m-d',strtotime($datefilter['from_date'])));

        if(empty($datefilter['from_date']) && !empty($datefilter['to_date']))
            $order = $order->where('created_at', '<=', date('Y-m-d',strtotime($datefilter['to_date'])));

        if(!empty($datefilter['from_date']) && !empty($datefilter['to_date']))
            $order = $order->whereBetween('created_at', [$datefilter['from_date'], $datefilter['to_date']]);

        $order = $order->where($conditions);

        return $order->count();
    }

    public function listOrder($sessionid)
    {
        return $this->transaction->where(['session_id' => $sessionid])->orderBy('created_at','DESC')->get();
    }

    public function create($transactionData)
    {
        return $this->transaction->create($transactionData);
    }

    public function createDetail($transactionData)
    {
        return $this->transactionDetail->insert($transactionData);
    }

    public function trxDetail($invoicenumber)
    {
        return $this->transaction
                    ->with(['shop','payment','items','items.product'])
                    ->where(['invoice_number' => $invoicenumber])->first();
    }
}
