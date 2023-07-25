<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';
    protected $fillable = ['MaKH', 'password', 'email', 'name', 'address', 'phone', 'hinhanh', 'birthday'];
    protected $primaryKey = 'MaKH';
    public $timestamps = false;
    protected $hidden = ['password'];
}