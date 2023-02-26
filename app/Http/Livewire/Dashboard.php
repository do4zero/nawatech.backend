<?php

namespace App\Http\Livewire;

use App\Services\Transaction\API\TransactionService;
use Livewire\Component;

class Dashboard extends Component
{
    public $from_date = '';
    public $to_date = '';

    public function render(TransactionService $transaction)
    {
        $shop = app('App\Services\Shop\GetShopInformationService')->getInfoByAuth()['data'];
        $datefilter = ['from_date' => $this->from_date,'to_date' => $this->to_date];
        $conditions =['shop_id' => $shop['shop']['id']];

        $totalOrder = $transaction->totalOrder($datefilter,$conditions);

        $conditions['status'] = 'WAITING';
        $waitingOrder = $transaction->totalOrder($datefilter,$conditions);

        $conditions['status'] = 'FAILED';
        $failedOrder = $transaction->totalOrder($datefilter,$conditions);

        $conditions['status'] = 'SUCCESS';
        $successOrder = $transaction->totalOrder($datefilter,$conditions);

        $bagikanLink =  env('FE_BASE_PATH','http://localhost:8081/').'toko/'.$shop['shop']['code'];

        return view('livewire.dashboard',[
            'totalOrder' => $totalOrder['data'] ?? 0,
            'waitingOrder' => $waitingOrder['data'] ?? 0,
            'failedOrder' => $failedOrder['data'] ?? 0,
            'successOrder' => $successOrder['data'] ?? 0,
            'bagikanLink' => $bagikanLink
        ]);
    }
}
