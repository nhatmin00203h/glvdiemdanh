<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XinPhepOff extends Model
{
    protected $table = 'xin_phep_offs';
    protected $primaryKey = 'xinphep_id';

    protected $fillable = [
        'user_id',
        'buoile_id',
        'ly_do',
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
