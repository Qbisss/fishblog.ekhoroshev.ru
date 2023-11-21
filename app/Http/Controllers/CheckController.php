<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    public function check($id)
    {
        if(!$this->isAdmin())
                return redirect('/');

        $post = DB::table('check_posts')
            ->select('check_posts.*', 'users.name')
            ->where('check_posts.id', $id)
            ->leftJoin('users', 'check_posts.email', '=', 'users.email')
            ->get()
            ->first();


        return view('check', ['post' => $post]);
    }

    public function publish(Request $request, $id)
    {
        if(!$this->isAdmin())
            return redirect('/');

        
        $do = $request->do;

        $post = DB::table('check_posts')->where('id', $id)->get()->first();

        switch($do)
        {
            case 'acces':
                {
                    DB::table('table_posts')->insert([
                        'email' => $post->email,
                        'name' =>$post->name,
                        'post' => $post->post,
                        'title' => $post->title,
                        'info' => $post->info,
                        'image' => $post->image,
                        'category' => $post->category,
                        'date' => now()
                    ]);

                    DB::table('check_posts')->where('id', $id)->delete();
                    return redirect('/admin');
                }

            case 'remove':
                {
                    DB::table('check_posts')->where('id', $id)->delete();
                    return redirect('/admin');
                }
            
            case 'edit':
                {
                    DB::table('check_posts')->where('id', $id
                    )->update(['status' => 'edit', 'note' => $request->info]);
                    return redirect('/admin');
                }

            default: return redirect('/');
        }
    }

    private function isAdmin()
    {
        if(Auth::guard('admin')->check())
            return true;

        return false;
    }
}
