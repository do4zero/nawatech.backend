<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'metode_pembayaran';
    protected $guarded = [];

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id','payment_id');
    }
}
