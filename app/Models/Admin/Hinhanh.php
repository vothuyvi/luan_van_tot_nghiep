<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hinhanh extends Model
{
    use HasFactory;
    protected $table='anh';
    protected $primaryKey='MaAnh';
    protected $keyType='string';
    protected $fillable=[

        'MaAnh',
        'HinhAnh',
        'MaSP',


    ];
    public $timestamps = false;}