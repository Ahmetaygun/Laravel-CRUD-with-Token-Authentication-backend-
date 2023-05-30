<?php
//bos controller kullanmıyorum
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($request->email)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(){
    if(auth('user')->user()){

        auth('user')->user()->tokens()->delete();
        return response([
            'message' => 'Kullanıcı cıkısı basarılı!!'
        ]);

    }
    else
        {
          return response([
          'message' => 'Kullanıcı bulunamadı!!'
        ]);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Hatalı kullanıcı girişi.'
           ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);

    }
}
