<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return date('d F Y, H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d F Y, H:i:s',strtotime($value));
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id')->select([
            'id',
            'name',
        ]);
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_id','id')->select([
            'id',
            'name',
            'image',
            'type',
            'admin'
        ]);
    }

    public function items()
    {
        return $this->hasMany(TransactionDetail::class,'transaction_id','id')->select([
            'id',
            'product_id',
            'transaction_id',
            'product_name',
            'price',
            'qty',
            'amount',
        ]);
    }
}
