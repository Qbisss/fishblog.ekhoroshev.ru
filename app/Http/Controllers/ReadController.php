<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function read($id)
    {
        $post = DB::table('table_posts')->where('id', $id)->get()->first();
        $random = DB::table('table_posts')->where('category', $post->category)->where('id', '!=', $id)->inRandomOrder()->take(2)->get();
        return view('read', ['post' => $post, 'random' => $random]);
    }
}
