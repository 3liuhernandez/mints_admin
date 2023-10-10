<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //

    public function login(Request $request) {
        // TODO: login sso
        $this->logout();
        return view("auth.login");
    }

    public function validate_login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => 'required|string|exists:users,email',
            "password" => 'required|string',
        ],[
            'required' => 'Todos los campos son obligatorios',
            'string' => 'Debe ingresar solo texto'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $datos = $validator->validated();

        $msg_login = 'Autenticación incorrecta';
        $email = $datos['email'];
        $password = $datos['password'];

        // try login
        $login = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        // login successfull
        if ($login) return redirect()->route('home');

        return response([
            'success'=> false,
            'message'=> $msg_login,
        ], 422);

    }


    protected function logout() {
        session()->flush();
        session()->regenerate();
        session()->save();
        Auth::logout();
    }
}
