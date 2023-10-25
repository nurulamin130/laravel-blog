<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class VisitorAuthController extends Controller
{
    private static $visitor;
    public function signupView(){
        return view('front-end.auth.signup');
    }

    public function signup(Request $request){
        Visitor::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        return back();
    }
    public function visitorSignIn(){
        return view('front-end.auth.signin');
    }

    public function visitorLogInCheck(Request $request){
        self::$visitor =Visitor::where('email',$request->user_name)
            ->orWhere('mobile',$request->user_name)
            ->first();

        if (self::$visitor){
            if (password_verify($request->password,self::$visitor->password)){

                Session::put('visitorId',self::$visitor->id);
                Session::put('visitorName',self::$visitor->username);
                Session::put('visitorEmail',self::$visitor->email);
                Session::put('visitorMobile',self::$visitor->mobile);

                return redirect(route('home'))->with('message','welcome');

            }else{
                return back()->with('message','please use valid password');
            }
        }else{
            return back()->with('message','please use valid email or mobile');
        }
    }

    public function visitorLogOut(){

        Session::forget('visitorId');
        Session::forget('visitorName');
        Session::forget('visitorEmail');
        Session::forget('visitorMobile');
        return back();

    }
}
