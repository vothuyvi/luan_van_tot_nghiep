<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;
    protected $table='khachhang';
    protected $primaryKey='MaKH';
    protected $keyType='string';
    protected $fillable=[

        'MaKH',
        'password',
        'name',
        'address',
        'phone',
        'hinhanh',
        'birthday',
        'email',


    ];
    public $timestamps = false;
}