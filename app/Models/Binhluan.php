<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table = 'binhluan';
    public $timestamps = false;

    public function khachhang()
    {
        return $this->belongsTo(Khachhang::class, 'MaKH', 'MaKH');
    }
}
