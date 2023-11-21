<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{

    public function edit($id)
    {
        $post = DB::table('check_posts')->where('id', $id)->get()->first();
        if(!$post)
            return view('personal');

        return view('rewrite', ['post' => $post]);
    }

    public function post(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/');
        }

        $request->validate([
            'editor' => 'required',
            'header' => 'required|max:128',
            'info' => 'required|max:255',
            'image' => 'required|url'
        ]);

        $text = $request->input('editor');
        $title = $request->input('header');
        $info = $request->input('info');
        $image = $request->input('image');
        $category = $request->input('category');


        DB::table('check_posts')
            ->where('id', $request->id)
            ->update([
                'date' => now(),
                'post' => $text,
                'title' => $title,
                'info' => $info,
                'image' => $image,
                'category' => $category,
                'status' => 'check'
            ]);

        return view('personal');
    }
}
