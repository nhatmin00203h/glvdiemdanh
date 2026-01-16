<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichCongGiao extends Model
{
    protected $table = 'lich_cong_giao';
    protected $primaryKey = 'lich_cong_giao_id';

    protected $fillable = [
        'ngay',
        'ten_le',
        'loai_le',
        'mau_le',
        'la_le_buoc',
    ];

    public function buoiLe()
    {
        return $this->hasOne(BuoiLe::class, 'lich_cong_giao_id');
    }
}
