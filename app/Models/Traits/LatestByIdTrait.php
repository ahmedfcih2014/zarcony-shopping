<?php

namespace App\Models\Traits;

trait LatestByIdTrait
{
    public function scopeLatestId($query) {
        return $query->orderBy("id", "DESC");
    }
}
