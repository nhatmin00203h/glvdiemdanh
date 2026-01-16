<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemDanh extends Model
{
    protected $table = 'diem_danhs';
    protected $primaryKey = 'diemdanh_id';

    protected $fillable = [
        'user_id',
        'buoile_id',
        'thoigian_quet',
        'tre',
        'vitri_hople',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buoiLe()
    {
        return $this->belongsTo(BuoiLe::class, 'buoile_id');
    }
}
