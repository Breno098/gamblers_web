<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $avatars = [
        'cristiano-ronaldo.png',
        'messi.png',
        'neymar.png',
        'lukaku.png',
        'sergio-ramos.png',
        'harry-kane.png',
        'mo-salah.png',
        'griezmann.png',
        'isco.png',
        'luis-suarez.png',
        'luka-modric.png',
        'mbappe.png',
        'paul-pogba.png',
        'ramadel-falcao.png',
        'toni-kroos.png'
    ];

    public function showForm()
    {
        return view('auth.login', [
            'forgot_password' => false
        ]);
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect('/')->with('error_login', 'Usuário ou senha incorretos.');
    }

    public function register(RegisterRequest $request)
    {
        $inputs = $request->all();

        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['avatar'] = Arr::random($this->avatars);

        if( !User::create($inputs)) {
            return redirect('/register')->with('error_register', 'Erro ao se registrar, tente novamente.');
        };

        return $this->login($request);
    }



}
