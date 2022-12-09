<?php

namespace App\Models;

use App\Models\Traits\LatestByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, LatestByIdTrait;

    protected $fillable = [
        "title", "sku", "details", "price", "brand_id"
    ];

    protected $appends = [
        'small_details', 'small_sku', 'small_title'
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

    public function GetSmallDetailsAttribute() {
        $details = strip_tags($this->details);
        if (strlen($details) > 100) {
            $details = substr($details, 0, 100) ."...";
        }
        return $details;
    }

    public function GetSmallTitleAttribute() {
        $title = substr($this->title, 0, 100);
        strlen($this->title) > 100 ? $title = $title ."..." : null;
        return $title;
    }

    public function GetSmallSkuAttribute() {
        $sku = substr($this->sku, 0, 25);
        strlen($this->sku) > 25 ? $sku = $sku ."..." : null;
        return $sku;
    }
}
