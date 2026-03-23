<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'customer_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function items(){
        return $this->hasMany(CartItem::class);
    }

    public function total(){
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
}
