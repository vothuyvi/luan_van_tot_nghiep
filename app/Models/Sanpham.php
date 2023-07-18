<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'MaSP';

    public function loaisp()
    {
        return $this->belongsTo(Loaisp::class, 'MaLoai', 'MaLoai');
    }

    public function anh()
    {
        return $this->hasMany(Anh::class, 'MaSP', 'MaSP');
    }

    public function chitietdonhang()
    {
        return $this->hasMany(Chitietdonhang::class, 'MaSP', 'MaSP');
    }

    public function khuyenmai()
    {
    }

    public function binhluan()
    {
    }
}