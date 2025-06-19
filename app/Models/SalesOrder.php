<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $appends = ['total_amount'];

    public function products()
    {
        return $this->hasMany(SalesOrderProduct::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->quantity * $product->price;
        });
    }
}
