<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    use HasFactory;
    protected $table='trangthaithanhtoan';
    protected $primaryKey='MaThanhToan';
    protected $keyType='string';
    protected $fillable=[

        'MaThangToan',
        'TrangThaiThanhToan',
    ];
    public $timestamps = false;
    public function donhang(){
        return $this->hasMany(DonHang::class);
     }
}