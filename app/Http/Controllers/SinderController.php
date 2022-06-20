<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kebun;
use App\Models\taksasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
  
        return response()->json([
            'status'=>'success',
            'message'=>'Sinder Berhasil Ditambahkan']);
    }

    public function read(){
        $data = User::where('role','sinder')->get();

        return response()->json([
            'status' => 'success',
            'data'=>[
                'Sinder'=> $data]]);
    }

    public function detail($id){
        $data = User::find($id);

        return response()->json([
            'status' => 'success',
            'data'=>[
                'Sinder'=> $data]]);
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
        $kebun_sinder = DB::update("UPDATE kebun SET nama_sinder='$x' WHERE nama_sinder='$x'");
        }
        if($taksasi){
        $taksasi_sinder = DB::update("UPDATE taksasi SET nama_sinder='$x' WHERE nama_sinder='$x'");
        }

        return response()->json([
            'status'=>'success',
            'data'=>[
                'Sinder'=>$sinder]]);
    }

    public function delete($id){
        $sinder = User::find($id);
        $x = $sinder['nama'];
        $kebun = Kebun::where('nama_sinder',$x)->first();

        if(!$sinder){
            return response()->json([
                'status'=>'failed',
                'message'=>'Sinder tidak ditemukan']);
        } else {
            $sinder->delete();
            if($kebun){
            $kebun = DB::delete("DELETE FROM kebun WHERE nama_sinder='$x';");
            $taksasi = DB::delete("DELETE FROM taksasi WHERE nama_sinder='$x';");
            return response()->json([
                'status'=>'success',
                'message'=>'Sinder berhasil dihapus']);
            }
            return response()->json([
                'status'=>'success',
                'message'=>'Sinder berhasil dihapus']);
        }
    }
}
