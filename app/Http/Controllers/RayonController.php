<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RayonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_rayon' => 'required|string',
            'nama_lokasi' => 'required|string'
        ]);
        $data = $request->all();
        $y = $request['nama_rayon'];
        $z = $request['nama_lokasi'];
        $chk = DB::select("SELECT * FROM rayon WHERE nama_rayon='$y' AND nama_lokasi='$z'");
        
        if(empty($chk)){
        $rayon = Rayon::create($data);
        return response()->json([
            'status'=>'success',
            'message'=>'Data Berhasil Ditambahhkan']);
        } else {
            return response()->json([
                'status'=>'failed',
                'message'=>'Data Telah Ada']);
        }
        
    }

    public function read(){
        $rayon = Rayon::all();

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Rayon'=>$rayon]]);
    }

    public function detail($id){
        $rayon = Rayon::find($id);
        return response()->json([
            'status'=>'success',
            'data'=>[
                'Rayon'=>$rayon]]);
    }

    public function update (Request $request, $id){
        $rayon = Rayon::find($id);
        $nama_rayon = $rayon['nama_rayon'];
        $nama_lokasi = $rayon['nama_lokasi'];

        if(!$rayon){
            return response()->json([
                'status'=>'failed',
                'message' => 'Rayon tidak ditemukan']);
        }

        $this->validate($request,[
            'nama_rayon' => 'string',
            'nama_lokasi' => 'string'
        ]);

        $data = $request->all();
        $data_rayon = $request['nama_rayon'];
        $data_lokasi = $request['nama_lokasi'];
        if($data_lokasi==""){
            $data_lokasi=$nama_lokasi;
        }
        $x = array(
            'nama_rayon'=>$request['nama_rayon'],
            'nama_lokasi'=>$request['nama_lokasi']
        );
        $rayon->fill($data);
        $rayon->save();
        
        $wilayah = DB::select("UPDATE wilayah SET nama_rayon='$data_rayon', nama_lokasi='$data_lokasi' 
                            WHERE nama_rayon='$nama_rayon' AND nama_lokasi='$nama_lokasi'");
        
        return response()->json([
            'status'=>'success',
            'data'=>[
                'Rayon'=>$rayon]]);
    }

    public function delete ($id){
        $rayon = Rayon::find($id);

        if(!$rayon){
            return response()->json([
                'status'=>'failed',
                'message' => 'Rayon tidak ditemukan']);
        }else{
            $rayon->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Rayon Berhasil Di Hapus']);
        }
    }
}

