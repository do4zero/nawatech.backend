<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transactions_detail';
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id')->select([
            'id',
            'name',
            'image',
        ]);
    }
}
