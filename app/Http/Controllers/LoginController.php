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
        $this->user_logout();
        section("Auth");
        return view("auth.login");
    }

    public function validate_login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => 'required|email|exists:users,email',
            "password" => 'required|string',
        ]);

        if ($validator->fails()) {
            return response(['validator' => $validator->errors()], 422);
        }

        $datos = $validator->validated();
        $email = $datos['email'];
        $password = $datos['password'];

        $msg_login = 'Autenticación incorrecta';
        $success = false;

        // try login
        $login = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        // login successfull
        if ($login) $success = $msg_login = true;

        return response([
            'success'=> $success,
            'message'=> $msg_login,
        ], $success ? 200 : 422);

    }

    protected function logout() {
        return redirect()->route('login');
    }

    protected function user_logout() {
        session()->flush();
        session()->regenerate();
        session()->save();
        Auth::logout();
    }
}
