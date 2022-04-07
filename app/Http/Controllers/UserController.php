<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function register(Request $request){
      $this->validate($request,[
          'nama' => 'required|string',
          'username' => 'required|unique:sinder|string',
          'password' => 'required|min:8',
          'wilayah' => 'required|string',
          'lokasi' => 'required|string'
      ]);
      $data = $request->all();
      $user = User::create($data);

      return response()->json(['message'=>'Sinder Berhasil Ditambahkan']);
  }

  public function login(Request $request){
      $this->validate($request,[
        'username' => 'required',
        'password' => 'required'
      ]);

      $username = $request->input('username');
      $password = $request->input('password');

      $user = User::where('username',$username)
                ->where('password',$password);

      if(!$user){
          echo "asdasd";
          return response()->json(['message'=>'username atau password salah']);
      }

        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token'=>$generateToken]);
        echo json_encode($user);
        return response()->json(['asdasdsa'=>'qeqeqe']);
      
      
  }
}
