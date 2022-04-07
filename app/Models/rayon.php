<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rayon extends Model
{   
    public $timestamps = false;
    protected $table = 'rayon';

    protected $fillable = [
        'nama_wilayah','nama_rayon','nama_lokasi'
    ];
}
