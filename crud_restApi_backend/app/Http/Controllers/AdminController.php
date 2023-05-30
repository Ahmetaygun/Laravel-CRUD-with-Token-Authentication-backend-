<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

use Validator;


class AdminController extends Controller
{
    public $successStatus=200;
    public function register(Request $request) 
    { 
      $validator = Validator::make($request->all(), [ 
        'name' => 'required', 
        'email' => 'required|email', 
        'password' => 'required', 
      ]);
      if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()], 401);            
      }
      $input = $request->all(); 
      $input['password'] = bcrypt($input['password']); 
      $admin= Admin::create($input); 
      $success['token'] =  $admin->createToken('token')-> accessToken; 
      $success['name'] =  $admin->name;
      return response()->json(['success'=>$success], $this-> successStatus); 
    }

    public function logout(){

        if(auth('admin')->user()){
          
          auth('admin')->user()->tokens()->delete();
          return response([
          'message' => 'Admin cıkışı basarılı!!'
        ]);

        }
        else
        {
          return response([
          'message' => 'Admin bulunamadı!!'
        ]);
        }
    }

    public function login(Request $request){
      
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
         
        $admin = Admin::where('email', $request->email)->first();
        //front kısmında token olusmadıgı zaman hata mesajı yazmıyor diye böyle birsey yaptım 
        //sıfır degeri dönüyor front da sıfır oldugu zaman giriş basarısız diyor ve  sıfırı 
        //hafızadan sildiriyor bu sayade token hiç olusmamıs gibi oluyor ve hata mesajını yazmıs oluyor
        if(!$admin || !Hash::check($request->password, $admin->password)){
          $token = 0;

          return response([
              'token' => $token
          ], 200);
        }

        $token = $admin->createToken($request->email)->plainTextToken;

        return response([
            'admin' => $admin,
            'token' => $token
        ], 200);
       
    }//end
    
}
