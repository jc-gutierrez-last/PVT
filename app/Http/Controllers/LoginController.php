<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function inicio(){
        //return view("inicio");

        $datos = $this->validate(request(), [
            'login' => 'login|required|string',
            'password' => 'password|required|string'
        ]);

        return $datos;
        
    }
}
