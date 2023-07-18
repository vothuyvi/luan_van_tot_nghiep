<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaisp extends Model
{
    use HasFactory;
    protected $table = 'loaisp';
    public $timestamps = false;

    public function sanpham() {
        return $this->hasMany(Sanpham::class, 'MaLoai', 'MaLoai');
    }
}