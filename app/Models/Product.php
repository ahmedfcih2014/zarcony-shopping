<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "sku", "details", "price", "brand_id"
    ];

    public function brand() {
        return $this->belongsTo(Brand::class, "brand_id");
    }

    // HINT: it's not the perfect way to filter products but is enough for current situation
    // in case more filter(s) added we most follow other patterns
    public function scopeFilter($query) {
        $keyword = request()->get("keyword") ?? null;
        return $query->when($keyword, function ($q) use ($keyword) {
            $q->where("title", "like", "%$keyword%");
            $q->orWhere("sku", "like", "%$keyword%");
            $q->orWhere("details", "like", "%$keyword%");
        });
    }

    public function scopeLatestId($query) {
        return $query->orderBy("id", "DESC");
    }
}
