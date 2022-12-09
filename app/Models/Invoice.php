<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id", "total_amount", "order_amount", "delivery_fees", "tax_amount",
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
