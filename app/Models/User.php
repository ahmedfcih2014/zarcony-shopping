<?php

namespace App\Models;

use App\Enum\UserEnum;
use App\Models\Traits\LatestByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LatestByIdTrait;

    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'user_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function SetPasswordAttribute($value) {
        if ($value) {
            return $this->attributes['password'] = bcrypt($value);
        }
    }

    public function scopeIsAdmin($query) {
        return $query->where('user_role', UserEnum::admin_role);
    }

    public function scopeIsClient($query) {
        return $query->where('user_role', UserEnum::client_role);
    }

    public function orders() {
        return $this->hasMany(Order::class, "user_id");
    }

    // HINT: it's not the perfect way to filter products but is enough for current situation
    // in case more filter(s) added we most follow other patterns
    public function scopeFilter($query) {
        $keyword = request()->get("keyword") ?? null;
        return $query->when($keyword, function ($q) use ($keyword) {
            $q->where("name", "like", "%$keyword%");
            $q->orWhere("mobile", "like", "%$keyword%");
            $q->orWhere("email", "like", "%$keyword%");
        });
    }

    public function isClientAuth() {
        return $this->user_role == UserEnum::client_role;
    }

    public function cart() {
        return $this->hasOne(Cart::class, "user_id");
    }
}
