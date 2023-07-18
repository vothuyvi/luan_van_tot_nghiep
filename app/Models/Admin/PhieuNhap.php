<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    use HasFactory;
    protected $table='phieunhap';
    protected $primaryKey='MaPN';
    protected $keyType='string';
    protected $fillable=[

        'MaPN',
        'NgayNhap',


    ];
    public $timestamps = false;
}