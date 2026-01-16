<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuoiLe extends Model
{
    protected $table = 'buoi_les';
    protected $primaryKey = 'buoile_id';

    protected $fillable = [
        'ngayle',
        'gio_batdau',
        'gio_tre',
        'gio_ketthuc',
        'loai_le',
        'lich_cong_giao_id',
        'is_active',
    ];

    public function lichCongGiao()
    {
        return $this->belongsTo(LichCongGiao::class, 'lich_cong_giao_id');
    }

    public function qrCode()
    {
        return $this->hasOne(QrCode::class, 'buoile_id');
    }

    public function diemDanhs()
    {
        return $this->hasMany(DiemDanh::class, 'buoile_id');
    }

    public function xinPhepOffs()
    {
        return $this->hasMany(XinPhepOff::class, 'buoile_id');
    }
}
