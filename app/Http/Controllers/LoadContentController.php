<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoadContentController extends Controller
{
    public function loadContent(Request $request)
    {
        if($request->category == 'none')
            $posts = DB::table('table_posts')->orderBy('id', 'desc')->skip($request->last*3)->take(3)->get();
        else
            $posts = DB::table('table_posts')->where('category', $request->category)->orderBy('id', 'desc')->skip($request->last*3)->take(3)->get();

        if(!$posts)
            return response()->json(['noposts' => true]);
        
        $html = [];

        foreach($posts as $post)
        {
            array_push($html , '<h3 class="st-m-l"><a href="/read/'.$post->id.'" class="h-h">'.$post->title.'</a></h3>
                    <div class="d-flex st-m-l s-a">
                        <div class="col-6">
                        '.date("d.m.Y",strtotime("$post->date")).'
                        </div>
                        <div class="col-6">
                        Автор: '.$post->name.'
                        </div>
                    </div>
                        <a href="/read/'.$post->id.'">
                            <img src="'.$post->image.'" 
                            class="st-i" alt="">
                        </a>
                    <p class="st-a">
                    '.$post->info.'
                    </p>
                    <div class="d-flex justify-content-between st-m-l">
                    <div class="d-flex">
                        <a href="/read/'.$post->id.'" class="r-n">Читать полностью</a>
                    </div>
                    <div class="d-flex">
                        <form data-action="like" id="likeForm'.$post->id.'" action="#">
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                         
                        <p class="like-amount" id="amount'.$post->id.'">'.$post->likes.'</p>                     
                         
                        '.$this->getLikes($post).'
                        </form>
                    </div>
                    </div>');
        }
        ksort($html, SORT_NUMERIC);
        return response()->json($html);
    }

    public function getLikes($post)
    {
        $html = '';

        if(Auth::check())
        {
            $userLikes = explode(",", Auth::user()->likes);

            if(in_array($post->id, $userLikes))
                $html = '<button type="submit" id="submitlike'.$post->id.'" class="like-liked"><i class="fa-solid fa-heart"></i></button>';
            else
                $html = '<button type="submit" id="submitlike'.$post->id.'" class="like"><i class="fa-solid fa-heart"></i></button>';
        }
        else
        {
            $html = '<button type="submit" class="like"><i class="fa-solid fa-heart"></i></button>';
        }

        return $html;
    }
}
