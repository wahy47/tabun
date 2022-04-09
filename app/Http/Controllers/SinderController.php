<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kebun;
use App\Models\Taksasi;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Js;

class SinderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function register(Request $request){
        $this->validate($request,[
            'nama' => 'string',
            'username' => 'required|unique:sinder|string',
            'role'=> 'required|in:admin,sinder',
            'password' => 'required|min:8',
            'wilayah' => 'string',
            'lokasi' => 'string'
        ]);
        $data = $request->all();
        $sinder = User::create($data);
  
        return response()->json(['message'=>'Sinder Berhasil Ditambahkan']);
    }

    public function read(){
        $data = User::where('role','sinder')->get();

        return response()->json([
            'status' => 'success',
            'data'=> $data
        ]);
    }

    public function detail($id){
        $data = User::find($id);

        return response()->json($data);
    }

    public function update(Request $request, $id){
        $sinder = User::find($id);
        $x = $sinder['nama'];
        $kebun = Kebun::where('nama_sinder',$x)->first();
        $taksasi = Taksasi::where('nama_sinder',$x)->first();

        $data = $request->all();
        $z = array('nama_sinder'=>$request['nama']);
        $sinder->fill($data);
        $sinder->save();

        if($kebun){
        $kebun->fill($z);
        $kebun->save();
        }
        if($taksasi){
        $taksasi->fill($z);
        $taksasi->save();
        }

        return response()->json($sinder);
    }

    public function delete($id){
        $sinder = User::find($id);
        $x = $sinder['nama'];
        $kebun = Kebun::where('nama_sinder',$x)->first();
        $taksasi = Taksasi::where('nama_sinder',$x)->first();

        if(!$sinder){
            return response()->json(['message'=>'Sinder tidak ditemukan']);
        } else {
            $sinder->delete();
            $kebun->delete();
            $taksasi->delete();
            return response()->json(['message'=>'Sinder berhasil dihapus']);
        }
    }

    
}
