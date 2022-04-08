<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kebun extends Model
{   
    public $timestamps = false;
    protected $table = 'kebun';

    protected $fillable = [
        'nama_kebun','luas','petak','jenis_tebu','kategori','nama_sinder','wilayah',
    ];
}
