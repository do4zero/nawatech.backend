<?php

namespace App\Interfaces\Payment\API;

interface FEPaymentMethodInterface
{
    public function findAll($code);
    public function create(array $paymentMethodData);
}
