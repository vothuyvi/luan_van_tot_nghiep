<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loai extends Model
{
    use HasFactory;
    protected $table='loaisp';
    protected $primaryKey='MaLoai';
    protected $keyType='string';
    protected $fillable=[
        'MaLoai',
        'TenLoai',
    ];
    public $timestamps = false;
// 1 LOẠI CÓ NHIỀU SẢN PHẨM JOIN DÙNG hasMany
     public function sanphams(){
        return $this->hasMany(sanpham::class,'Maloai','MaLoai');
     }
    
}