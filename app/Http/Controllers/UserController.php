<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class UserController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function register_do(Request $request){
        $this->validate($request, [
            'firstName'  => 'required|min:3',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|min:6'
        ]);
        
        $role = Hash::make('Makarya@user');
        $email_verification_code = Str::random(32);
        $query = [
            'role' => $role,
            'name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_code' => $email_verification_code,
            'created_at' => Carbon::now()
        ];
        if(User::insert($query) && $this->send_mail_do($request->email, $request->firstName, $email_verification_code)){
            return back()->with('success', 'Registrasi Anda telah berhasil. Harap konfirmasi email Anda untuk menggunakan layanan kami.');
        }else{
            return back()->with('error', 'Maaf sistem sedang sibuk.');
        }
    }

    public function login(){
        if(Auth::id()){
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function login_do(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }else{
            return back()->with('error', 'Maaf email atau password anda salah.');
        }
    }

    public function loggedOut(){
        Auth::logout();
        Session::flush();
        return redirect('login');
    }

    public function index(){
        return view('user.index', ['user' => Auth::user()]);
    }

    public function send_mail_do($email, $name, $email_verification_code)
    {
        $mail = new EmailVerification($name, $email_verification_code);
        Mail::to($email)->send($mail); 

        if(Mail::failures()){
            return false;
        }

        return true;
    }
}