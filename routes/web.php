<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\LikeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'main']);
Route::get('/{category}', [HomeController::class, 'category'])->whereIn('category', ['spin', 'float', 'feeder']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/write', function() { return view('write'); })->middleware(['auth']);
Route::post('/post', [PostController::class, 'post']);
Route::get('/read/{id}', [ReadController::class, 'read']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/admin', [AuthController::class, 'show_admin']);
Route::get('/check/{id}', [CheckController::class, 'check']);
Route::post('/publish/{id}', [CheckController::class, 'publish']);
Route::post('/like', [LikeController::class, 'like']);
Route::get('/edit/{id}', [EditController::class, 'edit']);
Route::post('/republish', [EditController::class, 'post']);
Route::post('/addcomment', function(Request $request)
{
    if(!Auth::check())
        return;

        if(strlen($request->comment) < 6)
            return response()->json(['error' => "Слишком маленький комментарий"]);

        if(strlen($request->comment) > 256)
            return response()->json(['error' => "Слишком большой комментарий"]);

        if(str_contains($request->comment, 'http'))
            return response()->json(['error' => "Нельзя вставлять ссылки"]);

        if($request->comment != strip_tags($request->comment))
            return response()->json(['error' => "Запрещены html теги в комментариях!"]);

        DB::table('comments')->insert([
            'email' => Auth::user()->email,
            'name' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
            'date' => now(),
            'comment' => $request->comment,
            'postid' => $request->id
        ]);

    return response()->json(['name'=> Auth::user()->name, 'date' => date("d.m.Y H:i",strtotime(now())), 'comment' => $request->comment]);
});


Route::prefix('register')->group(function(){
    Route::get('/', [AuthController::class, 'show_register']);
    Route::post('/post', [AuthController::class, 'register']);
});

Route::prefix('login')->group(function(){
    Route::get('/', [AuthController::class, 'show_login']);
    Route::post('/post', [AuthController::class, 'login']);
});

Route::prefix('reset')->group(function(){
    Route::get('/', [AuthController::class, 'show_reset']);
    Route::post('/post', [AuthController::class, 'reset']);
    Route::post('/pass', [AuthController::class, 'change_pass']);
    Route::get('/{token}', [AuthController::class, 'reset_pass']);
});

Route::prefix('personal')->group(function(){
    Route::get('/', [PersonController::class, 'show'])->middleware(['auth']);
    Route::get('/publish', [PersonController::class, 'show_publish_posts']);
    Route::get('/check', [PersonController::class, 'show_check_posts']);
});