<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
     
        $posts = DB::table('table_posts')
        ->where('title', 'LIKE', "%{$search}%")
        ->orWhere('info', 'LIKE', "%{$search}%")
        ->orWhere('post', 'LIKE', "%{$search}%")
        ->orderBy('id', 'desc')
        ->get();
        
        return view('home', ['posts' => $posts]);
    }
}
