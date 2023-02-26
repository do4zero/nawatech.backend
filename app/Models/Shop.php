<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $guarded = [];

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id','shop_id');
    }
}
