<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function show()
    {
        return view('personal');
    }

    public function show_publish_posts()
    {
        $posts = DB::table('table_posts')->where('email', Auth::user()->email)->orderBy('id', 'desc')->get();

        return view('ppublish', [ 'posts' => $posts]);
    }

    public function show_check_posts()
    {
        $posts = DB::table('check_posts')->where('email', Auth::user()->email)->orderBy('id', 'desc')->get();

        return view('pcheck', [ 'posts' => $posts]);
    }
}
