<?php

namespace App\Http\Livewire;

use App\Services\Transaction\API\TransactionService;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;
    public $searchTerm = '';
    public $from_date = '';
    public $to_date = '';

    public function render(TransactionService $transaction)
    {
        $shop = app('App\Services\Shop\GetShopInformationService')->getInfoByAuth()['data'];

        $data = $transaction->findAll($this->searchTerm,[
                'shop_id' => $shop['shop']['id'],
            ],
            [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date
            ]
        );

        $bagikanLink =  env('FE_BASE_PATH','http://localhost:8081/').'toko/'.$shop['shop']['code'];

        return view('livewire.order-list', [
            'oderlist' => $data['data'],
            'bagikanLink' => $bagikanLink,
        ]);
    }
}
