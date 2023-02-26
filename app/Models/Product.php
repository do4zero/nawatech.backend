<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('app/'.$value);
        } else {
            return asset('app/noimage.png');
        }
    }

    public function getPriceAttribute($value)
    {
        return (int) $value;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d F Y, H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d F Y, H:i:s',strtotime($value));
    }

    public function transaction_detail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }
}
