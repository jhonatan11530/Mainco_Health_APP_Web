<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

use Validator;
use Hash;
use Auth;


class LoginController extends Controller
{

    public function registrar(Request $request)
    {
        $usuario = $request->all();
        
        $validator = Validator::make($usuario, [
            'NomUsuario'    => 'required|max:50',
            'Email'    => 'required|max:50|confirmed',
            'password'  => 'required|max:50|confirmed',
        ]);

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $usuario['password'] = Hash::make($usuario['password']);

        User::create($usuario);
        return redirect('login');
    }
    
    public function validar(Request $request)
    {

        $datos = $request->only('cedula', 'password');
        
        if (Auth::attempt($datos)) {
            return redirect()->intended('inicio');
        } else {

            return redirect('login')->with('message', 'Error en los datos de acceso');
        }
        
    }

}