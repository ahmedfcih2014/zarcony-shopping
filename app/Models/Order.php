<?php

namespace App\Models;

use App\Enum\OrderEnum;
use App\Models\Traits\LatestByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, LatestByIdTrait;

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

    // HINT: it's not the perfect way to filter orders but is enough for current situation
    // in case more filter(s) added we most follow other patterns
    public function scopeFilter($query) {
        $state = request()->get("state") ?? null;
        return $query->when($state && in_array($state, OrderEnum::getStatus()), function ($q) use ($state) {
            $q->where('order_status', $state);
        });
    }
}
