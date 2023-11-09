<?php
use Illuminate\Support\Facades\Log;



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
