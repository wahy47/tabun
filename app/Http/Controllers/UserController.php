<?php

namespace App\Http\Controllers;

use App\Models\User;
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
      return response()->json([
        'status' => 'failed',
        'message' => 'Failed to Login'
      ]);
    }

    $generateToken = bin2hex(random_bytes(40));
    $user->update([
      'token'=>$generateToken
    ]);

    return response()->json([
        'status' => 'success',
        'token' => $generateToken,
        'data' =>[
            'User'=>$user
      ]]
    );
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
  
      return response()->json([
          'status'=>'success',
          'message'=>'Logout Success'
          ]);
    }
  }
}
