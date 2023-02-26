<?php

namespace App\Repositories\API;

use App\Interfaces\Payment\API\FEPaymentMethodInterface;
use App\Models\PaymentMethod;

class FEPaymentMethodRepository implements FEPaymentMethodInterface
{
    protected $paymentmethod;

    function __construct(PaymentMethod $paymentmethod) {
        $this->paymentmethod = $paymentmethod;
    }

    public function findAll($code)
    {
        return $this->paymentmethod->all();
    }

    public function create(array $paymentMethodData)
    {
        return $this->paymentmethod->create($paymentMethodData);
    }
}
