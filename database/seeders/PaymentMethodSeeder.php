<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $paymentMethod = app('App\Interfaces\Payment\API\FEPaymentMethodInterface');

        $data = [
            [
                'name' => 'Bank Mandiri',
                'image' => 'bank mandiri.png',
                'type' => 'VA',
                'admin' => 1000,
            ],
            [
                'name' => 'Bank BRI',
                'image' => 'bank bri.jpg',
                'type' => 'VA',
                'admin' => 1000,
            ],
            [
                'name' => 'QRIS',
                'image' => 'qrisimg.png',
                'type' => 'QRIS',
                'admin' => 1000,
            ],
            [
                'name' => 'Bank Mega Syariah',
                'image' => 'logo_bsmi.png',
                'type' => 'VA',
                'admin' => 1000,
            ],
            [
                'name' => 'LinkAja',
                'image' => 'linkaja.png',
                'type' => 'EMONEY',
                'admin' => 1000,
            ],
            [
                'name' => 'OVO',
                'image' => 'ovologo.png',
                'type' => 'EMONEY',
                'admin' => 1000,
            ],
            [
                'name' => 'Gopay',
                'image' => 'logogopay.png',
                'type' => 'EMONEY',
                'admin' => 1000,
            ],
        ];

        foreach($data as $row){
            $paymentMethod->create($row);
        }
    }
}
