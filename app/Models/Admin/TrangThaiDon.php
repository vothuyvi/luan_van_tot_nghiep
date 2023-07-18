<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrangThaiDon extends Model
{
    use HasFactory;
    protected $table='trangthaidonhang';
    protected $primaryKey='MaTT';
    protected $keyType='string';
    protected $fillable=[
        'MaTT',
        'TrangThaiDon',
    ];
    public $timestamps = false;
}