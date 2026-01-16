<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'google_id',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Quan hệ: user -> điểm danh
     */
    public function diemDanhs()
    {
        return $this->hasMany(DiemDanh::class, 'user_id');
    }

    /**
     * Quan hệ: user -> xin phép off
     */
    public function xinPhepOffs()
    {
        return $this->hasMany(XinPhepOff::class, 'user_id');
    }

    /**
     * Helper
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
}
