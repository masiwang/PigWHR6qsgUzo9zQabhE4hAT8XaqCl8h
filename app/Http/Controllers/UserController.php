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
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    //=== API start here ===
    public function _login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function _register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function _getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}