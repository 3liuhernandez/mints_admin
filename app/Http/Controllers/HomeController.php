<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {
        section("Home");
        return view("home/home");
    }
}
