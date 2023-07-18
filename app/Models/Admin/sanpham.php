<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $primaryKey='MaSP';
    protected $keyType='string';
    protected $fillable=[

        'MaSP',
        'TenSP',
        'SoLuong',
        'NgayThem',
        'MoTa',
        'GiaTien',
        'KichThuoc',
        'HinhAnh',
        'MaLoai',
        'MaKM',
    ];
    public $timestamps = false;
    //1 san phẩm có 1 loại join bằng hasone
    public function loai(){
        return $this->hasOne(loai::class,'MaLoai','MaLoai');
     }
     public function phieunhap(){
        return $this->hasOne(phieunhap::class,'MaSP','MaSP');
     }

}