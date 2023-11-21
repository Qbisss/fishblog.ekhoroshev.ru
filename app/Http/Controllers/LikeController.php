<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        if(!Auth::check())
            return;

        $user = DB::table('users')
        ->select('likes')
        ->where('email', Auth::user()->email)
        ->get()
        ->first();

        $post = DB::table('table_posts')
        ->select('likes')
        ->where('id', $request->id)
        ->get()
        ->first();

        $userLikes = null;
        
        if($user->likes != null)
        {
            $userLikes = explode(",", $user->likes);
        }
        else
        {
            $userLikes = $request->id;

            DB::table('users')
            ->where('email', Auth::user()->email)
            ->update(['likes' => $userLikes]);

            DB::table('table_posts')
            ->where('id', $request->id)
            ->update(['likes' => $post->likes + 1]);
            return response()->json(['likes'=> $post->likes + 1, 'class' => 'like-liked']);
        }

        if(in_array($request->id, $userLikes))
        {
            $userLikes = array_diff($userLikes, [$request->id]);
            $likes = implode(',', $userLikes);

            DB::table('users')
            ->where('email', Auth::user()->email)
            ->update(['likes' => $likes]);

            if($request->amount - 1 > 0)
            {
                DB::table('table_posts')
                ->where('id', $request->id)
               ->update(['likes' => $post->likes - 1]);
            }
            else 
            {
                return response()->json(['likes'=> 0, 'class' => 'like']);
            }
            return response()->json(['likes'=> $post->likes - 1, 'class' => 'like']);
        }

        array_push($userLikes, $request->id);
        $likes = implode(',', $userLikes);

        DB::table('users')
        ->where('email', Auth::user()->email)
        ->update(['likes' => $likes]);

        DB::table('table_posts')
        ->where('id', $request->id)
        ->update(['likes' => $post->likes + 1]);
        return response()->json(['likes'=> $post->likes + 1, 'class' => 'like-liked']);
    }
}
