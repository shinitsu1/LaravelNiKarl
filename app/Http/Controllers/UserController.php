<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        return 'Hello from UserController';
    }

    public function show($id){

        $data = array (
            "id" => $id,
            "name" => "LaravelNiKarl",
            "age" => 21,
            "email" => "karllewistdoctolero@gmail.com"
        );
        return view('user', $data);
    }

    public function login(){
        return view ('user.login');
    }

    public function process(Request $request){
        $validated = $request->validate([
            "email" => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($validated)){
        $request->session()->regenerate();

        return redirect('/')->with('message', 'Welcome Back! ');
        }

        return back()->withErrors(['email' => 'Login Failed'])->onlyInput('email');
    }

    public function register(){
        return view('user.register');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Logout Successful');
    }





    public function store(Request $request){
       $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:6'
       ]);

       $validated['password'] = bcrypt($validated['password']);

       $user = User::create($validated);

       auth()->login($user);

    }


}
