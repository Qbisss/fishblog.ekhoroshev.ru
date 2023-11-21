<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetMail;

class AuthController extends Controller
{
    public static function check_admin()
    {
        if(Auth::guard('admin')->check())
        return true;

        return false;  
    }

    public function show_admin()
    {    
        if(self::check_admin())
        {
            $posts = DB::table('check_posts')
            ->select('check_posts.*', 'users.name')
            ->where('check_posts.status', 'check')
            ->leftJoin('users', 'check_posts.email', '=', 'users.email')
            ->orderBy('id', 'asc')
            ->get();
            return view('admin', ['posts' => $posts]);
        }

        return redirect('/');
    }

    public function show_login()
    {
        if(Auth::check())
        {
            return redirect('/');
        }
        return view('login');
    }
    
    public function show_register()
    {
        if(Auth::check())
        {
            return redirect('/');
        }

        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $request->checkbox))
        {
            $user = Auth::user();
            $auth = DB::table('users_admin')->where('email', $user->email)->where('password', $user->password)->first();
            
            if($auth)
                Auth::guard('admin')->login($user);
    
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Неправильно введен Email или пароль'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/');
    }

    public function register(Request $request)
    {     
        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'password2' => 'required|min:6',
        ]);
        
        $password = $request->password;
        $password2 = $request->password2;
        if($password != $password2)
        {
            return back()->withErrors([
                'password' => 'Не совпадают пароли'
            ])->onlyInput('password');
        }

        $name = $request->name;
        $email = $request->email;
        
        DB::table('users')->insert([
            'email' => $email,
            'password' => Hash::make($password),
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return view('registered');
    }

    public function show_reset()
    {
        if(Auth::check())
        {
            return redirect('/');
        }

        return view('reset');
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $auth = DB::table('users')->where('email', $email)->first();
        if(!$auth)
            return back()->withErrors([
            'email' => 'Пользователь не найден'
        ])->onlyInput('email');


        $str = Str::random(30);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $str,
            'created_at' => now()
        ]);

        $url = 'Перейдите по ссылке для восстановления пароля localhost/reset/'.$str;        
        mail($email, 'Восстановление пароля', $url);


        return view('reseted');
    }

    public function reset_pass($token)
    {
        $auth = DB::table('password_resets')->where('token', $token)->first();

        if(!$auth)
        {
            return redirect('/');
        }
        
        return view('resetpassword', ['email' => $auth->email]);
    }

    public function change_pass(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);


        DB::table('password_resets')->where('email', $request->email)->delete();
        return view('changed');
    }
}
