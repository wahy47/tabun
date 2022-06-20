<?php

namespace App\Http\Controllers;

use App\Models\taksasi;
use App\Models\kebun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TaksasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function read(Request $request){

        $akun = $request->header('token') ;
        $sinder = User::where('token',$akun)->first();
        $x = $sinder['nama'];

        $taksasi = DB::select("SELECT taksasi.id, taksasi.nama_sinder,taksasi.nama_kebun, kebun.luas, kebun.petak, kebun.jenis_tebu, kebun.kategori FROM `taksasi`
        LEFT JOIN kebun ON taksasi.id_kebun=kebun.id
        WHERE taksasi.nama_sinder='$x'");

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Taksasi'=>$taksasi]]);
    }

    public function detail($id){

        $taksasi = DB::select("SELECT taksasi.id, taksasi.nama_kebun, kebun.luas, taksasi.mandor ,taksasi.faktor_leng, taksasi.batang_per_meter, taksasi.batang_per_row, taksasi.batang_per_ha, taksasi.tinggi_ini, taksasi.tinggi_tebang, taksasi.diameter_batang, taksasi.berat_per_meter, taksasi.hit, taksasi.pandangan, taksasi.per_hit, taksasi.kui FROM `taksasi`
        LEFT JOIN kebun ON taksasi.id_kebun=kebun.id
        WHERE taksasi.id='$id'");

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Taksasi'=>$taksasi]]);
    }

    public function update(Request $request,$id){
        $taksasi = Taksasi::find($id);
        $data = $request->all();                
    
        $taksasi->fill($data);
        $taksasi->save();
        return response()->json([
            'status'=>'success',
            'data'=>[
                'Taksasi'=>$taksasi]]);
    }
}
