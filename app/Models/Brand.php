<?php

namespace App\Models;

use App\Models\Traits\LatestByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, LatestByIdTrait;

    protected $fillable = ['name'];

    protected $appends = [
        'small_name'
    ];

    public function products() {
        return $this->hasMany(Product::class, "brand_id");
    }

    // HINT: it's not the perfect way to filter products but is enough for current situation
    // in case more filter(s) added we most follow other patterns
    public function scopeFilter($query) {
        $keyword = request()->get("keyword") ?? null;
        return $query->when($keyword, function ($q) use ($keyword) {
            $q->where("name", "like", "%$keyword%");
        });
    }

    public function GetSmallNameAttribute() {
        $name = strip_tags($this->name);
        if (strlen($name) > 18) {
            $name = substr($name, 0, 18) ."...";
        }
        return $name;
    }
}
