<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
    'customer_id',
    'name',
    'email',
    'phone',
    'address',
    'total_price',
    'status',
    'payment_method'
];


public function customer(){
    return $this->belongsTo(User::class, 'customer_id');
}
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
