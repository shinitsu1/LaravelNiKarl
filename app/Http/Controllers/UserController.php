<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
