<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

  public function login(Request $request){
      $this->validate($request,[
        'username' => 'required',
        'password' => 'required'
      ]);

      $username = $request['username'];
      $password = $request['password'];
      $x = "";
      $user = User::where('username',$username)
                ->where('password',$password)->first();

      if(!$user){
        $admin = Admin::where('username',$username)
                        ->where('password',$password)->first();
        $x = "admin";
        if(!$admin){
          return response()->json(['message'=>'username atau password salah']);
        }
      }
      if ($x==="admin"){
        $generateToken = bin2hex(random_bytes(40));
        $admin->update([
            'token'=>$generateToken]);
        
        return response()->json($admin);
      }
      $generateToken = bin2hex(random_bytes(40));
      $user->update([
            'token'=>$generateToken]);
        
      return response()->json($user);    
  }
  public function logout(Request $request,$id){
    $x="";
    $token = $request->header('token');

    $user = User::where('token',$token)
                  ->where('id',$id)->first();
    if($user){
      $user->update([
        'token' => $x
      ]);
  
      return response()->json($user);
    }
    $admin = Admin::where('token',$token)
                    ->where('id',$id)->first();
    if($admin){
      $admin->update([
        'token'=>$x
      ]);
    }
    return response()->json($admin);
  }
}
