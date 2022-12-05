<?php

namespace App\Models;

use App\Enum\UserEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'user_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function SetPasswordAttribute($value) {
        return $this->attributes['password'] = $value ? bcrypt($value) : null;
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
}
