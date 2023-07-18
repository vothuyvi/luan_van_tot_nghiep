<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    use HasFactory;
    protected $table='tintuc';
    protected $primaryKey='MaTT';
    protected $keyType='string';
    protected $fillable=[

        'MaTT',
        'TieuDe',
        'NoiDung',
        'HinhAnh',
        'NgayDang',


    ];
    public $timestamps = false;
}