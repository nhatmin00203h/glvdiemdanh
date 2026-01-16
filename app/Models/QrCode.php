<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $table = 'qr_codes';
    protected $primaryKey = 'qrcode_id';

    protected $fillable = [
        'token',
        'buoile_id',
        'trangthai',
    ];

    public function buoiLe()
    {
        return $this->belongsTo(BuoiLe::class, 'buoile_id');
    }
}
