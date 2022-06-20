<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_wilayah' => 'required|string',
            'nama_rayon' => 'required|string',
            'nama_lokasi' => 'required|string'
        ]);
        $data = $request->all();
        $x = $request['nama_wilayah'];
        $y = $request['nama_rayon'];
        $z = $request['nama_lokasi'];
        $chk = DB::select("SELECT * FROM wilayah WHERE nama_wilayah='$x' AND nama_rayon='$y' AND nama_lokasi='$z'");
        
        if(empty($chk)){
        $rayon = Wilayah::create($data);
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
        $rayon = Wilayah::all();

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Wilayah'=>$rayon]]);
    }

    public function detail($id){
        $rayon = Wilayah::find($id);
        return response()->json([
            'status'=>'success',
            'data'=>[
                'Wilayah'=>$rayon]]);
    }

    public function update (Request $request, $id){
        $rayon = Wilayah::find($id);

        if(!$rayon){
            return response()->json([
                'status'=>'failed',
                'message' => 'Rayon tidak ditemukan']);
        }

        $this->validate($request,[
            'nama_wilayah' => 'string',
            'nama_rayon' => 'string',
            'nama_lokasi' => 'string'
        ]);

        $data = $request->all();

        $rayon->fill($data);

        $rayon->save();
        
        return response()->json([
            'status'=>'success',
            'data'=>[
                'Wilayah'=>$rayon]]);
    }

    public function delete ($id){
        $rayon = Wilayah::find($id);

        if(!$rayon){
            return response()->json(['message' => 'Rayon tidak ditemukan']);
        }else{
            $rayon->delete();
            return response()->json(['message'=>'Rayon Berhasil Di Hapus']);
        }
    }
}

