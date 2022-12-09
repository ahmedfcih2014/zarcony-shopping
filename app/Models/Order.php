<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "payment_method_id", "order_status", "address_line", "mobile"
    ];

    public function client() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function items() {
        return $this->hasMany(OrderItem::class, "order_id");
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class, "payment_method_id");
    }

    public function invoice() {
        return $this->hasOne(Invoice::class, 'order_id');
    }
}
