<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table='binhluan';
    protected $primaryKey='MaBL';
    protected $keyType='string';
    protected $fillable=[
        'MaBL',
        'NoiDung',
        'MaKH',
        'MaSP',
        'NgayBinhLuan',
    ];
    public $timestamps = false;
    public function products(){
        return $this->belongsTo(sanpham::class,'MaSP');
     }
}
