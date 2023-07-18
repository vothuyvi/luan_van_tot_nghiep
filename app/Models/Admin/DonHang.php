<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table='donhang';
    protected $primaryKey='MaDH';
    protected $keyType='string';
    protected $fillable=[

        'MaDH',
        'email',
        'TenNguoiNhan',
        'DiaChiNguoiNhan',
        'SDTNguoiNhan',
        'GhiChu',
        'MaPT',
        'NgayDat',
        'MaTT',
        'MaKM',
        'MaThanhToan',
        'MaKH'
    ];
    public $timestamps = false;
    public function thanhtoan(){
        return $this->belongsTo(thanhtoan::class,'MaThanhToan');
     }
}