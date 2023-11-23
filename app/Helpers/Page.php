<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

if (!function_exists('site_v')) {

    /**
     * GET CURRENT SITE VERSION
     * @return int site version
     */
    function site_v()
    {
        return 1.1;
    }
}


if (!function_exists('section')) {
    /**
     * set or get section page
     * @param string $section name of section page
     * @return string current section saved in session data
     */
    function section( string|bool $section = false) : string
    {
        if ( $section ) session()->put('section', $section );
        return session('section')??"Dashboard";
    }
}


if (!function_exists('load_component')) {
    function load_component( string|bool $section = false, string|bool $component = false ) {
        $section = str_replace(" ", "_", strtolower($section ? $section :session()));
        $path_component = "$section/components/$component";
        if ( view()->exists($path_component) ) return view($path_component)->render();
        return false;
    }
}

if (!function_exists('check_route')) {
    function check_route($route) {
        foreach(Route::getRoutes()->getRoutes() as $r){
            if($r->uri() == $route) return $r->getName();
        }
        return false;
    }
}

if (!function_exists('replace_accents')) {
    function replace_accents( string $string) : string {
        $string = htmlentities($string, ENT_COMPAT, "UTF-8");
        $string = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde|ring);/','$1',$string);
        return html_entity_decode($string);
    }
}