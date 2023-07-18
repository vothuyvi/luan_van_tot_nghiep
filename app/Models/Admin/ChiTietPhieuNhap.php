<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuNhap extends Model
{
    use HasFactory;
    protected $table='chitietphieunhap';
    protected $primaryKey='MaChiTiet';
    protected $keyType='string';
    protected $fillable=[

        'MaChiTiet',
        'MaSP',
        'MaPN',
        'GiaTien',
        'SoLuong',


    ];
    public $timestamps = false;
    public function sanpham(){
        return $this->hasMany(sanpham::class,'MaSP','MaSP');
     }
}