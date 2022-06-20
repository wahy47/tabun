<?php

namespace App\Http\Controllers;

use App\Models\kebun;
use App\Models\User;
use App\Models\taksasi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read(){
        //$user = User::all('nama','wilayah','lokasi')
        //            ->where('role','sinder')->first();

        $user = DB::select("SELECT id,nama, wilayah, lokasi FROM sinder WHERE role='sinder'");

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Sinder'=>$user]]);
    }

    public function detail($id){
        $user = User::find($id);
        $nama_user = $user['nama'];
        $wilayah_user = $user['wilayah'];
        $lokasi_user = $user['lokasi'];

        $sql = DB::select("SELECT sinder.nama, sinder.wilayah, sinder.lokasi, taksasi.mandor, kebun.nama_kebun, kebun.luas, kebun.petak, kebun. jenis_tebu, kebun.kategori,taksasi.faktor_leng, taksasi.batang_per_meter, taksasi.batang_per_row, taksasi.batang_per_ha, taksasi.tinggi_ini, taksasi.tinggi_tebang, taksasi.diameter_batang, taksasi.berat_per_meter, taksasi.hit, taksasi.pandangan, taksasi.per_hit, taksasi.kui
        FROM kebun
        left JOIN sinder ON kebun.nama_sinder=sinder.nama
        LEFT JOIN taksasi ON kebun.id=taksasi.id
        WHERE sinder.nama = '$nama_user'");

        if(!$sql){
            return response()->json([
                'status'=>'failed',
                'message'=>'Sinder Belum Memiliki Kebun']);
        }

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Report'=>$sql]]);
    }

}
