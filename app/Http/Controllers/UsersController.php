<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function user_login(Request $request){
        $request->validate([
            'email'=>['required'],
            'password'=>['required'],
        ]);

        if(Auth::attempt($request->only('email','password'))){
           return response()->json(Auth::user(), 200);
        }else{
            return response()->json([
                'status' => 'Incorrect email or password!'
            ]);
        }
        throw ValidationException::withMessages([
            'email' => ['Incorrect email or password!'],
        ]);
        
    }
    public function get_all_users(Request $request){
        $users = User::where('usertype', '=' ,'cafe')
        ->get();
        return response()->json([
            'status' => $users
        ]);
    }
    public function logout(){
      Auth::logout();
    }

    public function add_user(Request $request){
     
     $users = User::where('store_name', '=' , $request->storename)->get();
     if(count($users) === 0){
        User::create([
            'store_name' => $request->storename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'cafe',
            'year' => date('Y'),
            'status' => 'pending'
        ]);

        return response()->json([
            'status' => 'success'
        ]);
     }else{
         return response()->json([
            'status' => 'exist'
        ]);
     }

       

    }
    public function otp_submit(Request $request){
     if(session('otp') === $request->otp){
        return response()->json([
            'status' => true
        ]);
     }else{
        return response()->json([
            'status' => false,
            'otp' =>session('otp')
        ]);
     }
    }
}
