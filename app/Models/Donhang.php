<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $table = 'donhang';
    public $timestamps = false;
    protected $primaryKey = 'MaDH';

    public function chitietdonhang()
    {
        return $this->hasMany(Chitietdonhang::class, 'MaDH', 'MaDH');
    }
}
