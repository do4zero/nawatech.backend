<?php

namespace App\Services\Payment\API;

use App\Repositories\API\FEPaymentMethodRepository;
use Illuminate\Support\Facades\DB;

class PaymentMethodService
{
    private FEPaymentMethodRepository $paymentmethodRepository;

    function __construct(FEPaymentMethodRepository $paymentmethodRepository) {
        $this->paymentmethodRepository = $paymentmethodRepository;
    }

    public function display($params = array())
    {
        try {
            $paymentmethod = $this->paymentmethodRepository->findAll($params);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'data' => null,
                'reason' => $th->getMessage(),
                'message' => 'Payment Method failed to loaded'
            ];
        }

        return [
            'data' => $paymentmethod,
            'message' => 'Payment Method successfully loaded'
        ];
    }

    public function create($params = array())
    {
        DB::beginTransaction();
        try {
            $paymentmethod = $this->paymentmethodRepository->create($params);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'reason' => $th->getMessage(),
                'data' => null,
                'message' =>  $th->getMessage().'Payment Method failed to '. (empty($id) ? ' create' : 'update')
            ];
        }

        return [
            'status' => true,
            'data' => $paymentmethod,
            'message' => 'Payment Method successfully '. (empty($id) ?  ' created' : 'updated')
        ];
    }
}
