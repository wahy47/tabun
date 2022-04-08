<?php

namespace App\Http\Controllers;

use App\Models\taksasi;
use App\Models\Kebun;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaksasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function read(){
        $taksasi = Taksasi::all();

        return response()->json($taksasi);
    }

    public function detail($id){
        $taksasi = Taksasi::find($id);

        return response()->json($taksasi);
    }

    public function update(Request $request,$id){

        // $this->validate($request,[
        //     'mandor'=>'required',
        // ]);
        $taksasi = Taksasi::find($id);
        $data = $request->all();                
        // $sql = array(
        //     'mandor'=>$request['mandor'],
        //     'faktor_leng'=>$request['faktor_leng'],
        //     'batang_per_meter'=>$request['batang_per_meter'],
        //     'batang_per_row'=>$request['batang_per_row'],
        //     'batang_per_ha'=>$request['batang_per_ha'],
        //     'tinggi_ini'=>$request['tinggi_ini'],
        //     'tinggi_tebang'=>$request['tinggi_tebang'],
        //     'diameter_batang'=>$request['diameter_batang'],
        //     'batang_per_meter'=>$request['batang_per_meter'],
        //     'hit'=>$request['hit'],
        //     'pandangan'=>$request['pandangan'],
        //     'per_hit'=>$request['per_hit'],
        //     'kui'=>$request['kui']
        // );

        $taksasi->fill($data);
        $taksasi->save();
        return response()->json($taksasi);




        
    }
}
