<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'shop_id', 'status', 'total_amount',
        'delivery_address', 'payment_method', 'payment_status',
    ];

    public function shop() { return $this->belongsTo(Shop::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}