<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhang';
    public $timestamps = false;

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'MaSP', 'MaSP');
    }
}
