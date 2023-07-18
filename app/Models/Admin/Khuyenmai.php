<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model
{
    use HasFactory;
    protected $table='khuyenmai';
    protected $primaryKey='MaKM';
    protected $keyType='string';
    protected $fillable=[
        'MaKM',
        'TenKM',
        'PhanTram',
        'NgayKetThuc',
        'NgayBatDau',
        'TrangThai',
    ];
    public $timestamps = false;
}