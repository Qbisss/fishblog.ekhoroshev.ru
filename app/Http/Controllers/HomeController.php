<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main()
    {
        $posts = DB::table('table_posts')->orderBy('id', 'desc')->get();

        return view('home', [ 'posts' => $posts]);
    }

    public function category($category)
    {
        $posts = DB::table('table_posts')->where('category', $category)->orderBy('id', 'desc')->get();

        return view('home', [ 'posts' => $posts]);
    }
}
