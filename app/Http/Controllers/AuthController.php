<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (){
        return view ("auth.login");
    }

    public function registration(){
        return  view ("auth.registration");
    }

    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'role'=>'required',
            'password'=>'required|max:15|min:8'
        ]);
        $user= new User(); 
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->password=Hash::make($request-> password);
        $res=$user->save();
        if($res){
            return back()-> with('success','You have registered successfully');

        }else{
            return back()-> with('failed','Failed to register. Something wrong happened');

        }
    }

    public function loginUser(Request $request){
       $request->validate([
            'email'=>'required|email',
            'password'=>'required|max:15|min:8'
        ]);

        $user = User::where('email',"=", $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else{
                return back()-> with('failed','Password do not match.');
            }
          
        }else{
            return back()-> with('failed','The email is not registered.');

        }
    }

  /*  public function dashboard(){
        $data=array();
        if(Session::has ('loginId')){
            $data = User::where('id',"=", Session::get ('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }

    public function logout(){
        if(Session::has ('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }

    */

    public function dashboard(){
        $data=array();
        if(Session::has ('loginId')){
            $data = User::where('id',"=", Session::get ('loginId'))->first();
            if($data->role=="admin"){
                return view ('admindash', compact ('data'));
            }elseif($data->role=="user"){
                return view ('userdash', compact ('data'));
            }
        }
        
        // return view('userdash', compact('data'));
    }
    public function logout(){
        if(Session::has ('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}