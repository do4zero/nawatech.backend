<?php

namespace App\Interfaces\Transaction\API;

interface FETransactionRepositoryInterface
{
    public function list($searchTerm, array $conditions, array $datefilter);
    public function listOrder($sessionid);
    public function create(array $transactionData);
    public function trxDetail($invoicenumber);
    public function totalOrder(array $datefilter, array $conditions);
}
