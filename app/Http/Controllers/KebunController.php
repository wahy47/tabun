<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use App\Models\Taksasi;
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
            return response()->json(['message'=>'Nama kebun telah ada']);
        }
        $taks = array(
            'nama_sinder'=>$request['nama_sinder'],
            'nama_kebun'=>$request['nama_kebun']
        );
        $kebun = Kebun::create($data);
        $taksasi = Taksasi::create($taks);

        if(!$kebun){
            return response()->json(['message'=>'Gagal Menambahkan Data']);
        }

        return response()->json(['message'=>'Berhasil Menambahkan Data']);
    }

    public function read(){
        $kebun = Kebun::all();

        return response()->json($kebun);
    }

    public function detail($id){
        $kebun = Kebun::find($id);

        return response()->json($kebun);
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
        return  response()->json(['message'=>'Berhasil Mengubah Data']);
    }

    public function delete($id){
        $kebun = Kebun::find($id);
        $taksasi = Taksasi::find($id);

        if(!$kebun){
            return response()->json(['message' => 'Data kebun tidak ditemukan']);
        }else{
            $kebun->delete();
            $taksasi->delete();
            return response()->json(['message'=>'Data kebun berhasil di hapus']);
        }
    }
}
