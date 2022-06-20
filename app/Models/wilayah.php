<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Wilayah extends Model
{   
    public $timestamps = false;
    protected $table = 'wilayah';

    protected $fillable = [
        'nama_wilayah','nama_rayon','nama_lokasi'
    ];
}
