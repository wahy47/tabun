<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Taksasi extends Model
{
    public $timestamps = false;
    protected $table = 'taksasi';
  
    protected $fillable = [
        'nama_sinder','nama_kebun','id_kebun','mandor','faktor_leng','batang_per_meter','batang_per_row','batang_per_ha',
        'tinggi_ini','tinggi_tebang','diameter_batang','berat_per_meter','hit','pandangan','per_hit','kui',
    ];

}
