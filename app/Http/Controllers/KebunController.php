<?php

namespace App\Http\Controllers;

use App\Models\kebun;
use App\Models\taksasi;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class KebunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request){

        $this->validate($request,[
            'nama_kebun' => 'required|string',
            'luas' => 'required|string',
            'petak' => 'required|string',
            'jenis_tebu' => 'required|string',
            'kategori' => 'required|string',
            'nama_sinder' => 'required|string',
            'wilayah' => 'required|string'
        ]);

        $data = $request->all();
        $check = Kebun::where('nama_kebun',$request['nama_kebun'])
                        ->where('nama_sinder',$request['nama_sinder'])->first();
        if($check){
            return response()->json([
                'status'=>'failed',
                'message'=>'Nama kebun telah ada']);
        }
        
        $kebun = Kebun::create($data);
        $x = $kebun['id'];

        $taks = array(
            'nama_sinder'=>$request['nama_sinder'],
            'nama_kebun'=>$request['nama_kebun'],
            'id_kebun'=>$x
        );

        $taksasi = Taksasi::create($taks);

        if(!$kebun){
            return response()->json([
                'status'=>'failed',
                'message'=>'Gagal Menambahkan Data']);
        }

        return response()->json([
            'status'=>'success',
            'message'=>'Berhasil Menambahkan Data']);
    }

    public function read(){
        $kebun = Kebun::all();

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Kebun'=>$kebun]]);
    }

    public function detail($id){
        $kebun = Kebun::find($id);

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Kebun'=>$kebun]]);
    }

    public function update(Request $request,$id){
        $kebun = Kebun::find($id);
        $taksasi = Taksasi::find($id);
        $data = $request->all();
        $taks = array(
            'nama_sinder'=>$request['nama_sinder'],
            'nama_kebun'=>$request['nama_kebun']
        );
        $kebun->fill($data);
        $kebun->save();
        $taksasi->fill($taks);
        $taksasi->save();
        return  response()->json([
            'status'=>'success',
            'message'=>'Berhasil Mengubah Data']);
    }

    public function delete($id){
        $kebun = Kebun::find($id);
        $taksasi = Taksasi::where('id_kebun',$id)->first();

        if(!$kebun){
            return response()->json([
                'status'=>'failed',
                'message' => 'Data kebun tidak ditemukan']);
        }else{
            $kebun->delete();
            $taksasi->delete();
            return response()->json([
                'status'=>'success',
                'message'=>'Data kebun berhasil di hapus']);
        }
    }
}
