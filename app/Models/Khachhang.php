<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Khachhang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'khachhang';
    protected $fillable = ['MaKH', 'password', 'email', 'name', 'address', 'phone', 'hinhanh', 'birthday'];
    protected $primaryKey = 'MaKH';
    public $timestamps = false;
    protected $hidden = ['password'];
}