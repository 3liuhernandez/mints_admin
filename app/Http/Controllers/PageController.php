<?php

namespace App\Http\Controllers;

use App\Models\Coordination;
use App\Models\Member;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function load_component(Request $request, $section, $component_name) {
        return response([
            "component" => load_component($section, $component_name),
        ], 200);
    }

    public function home(Request $request) {
        section("Home");
        return view("home/home");
    }

    public function login(Request $request, ?string $params = null ) {
        $redirect = $request->get('redirect');
        if ( $redirect ) $redirect = check_route($redirect);

        (new LoginController)->user_logout();
        section("Auth");
        return view("auth.login", compact('redirect'));
    }

    public function logout() {
        return redirect()->route('login');
    }

    public function memberships(Request $request) {
        section("Memberships");
        $data['coords'] = [];
        $data['members'] = [];
        return view("memberships/index")->with($data);
    }
}
