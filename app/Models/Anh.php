<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    use HasFactory;
    protected $table = 'anh';
    public $timestamps = false;

    public function sanpham() {
        return $this->belongsTo(Sanpham::class, 'MaSP', 'MaSP'); 
    }
}