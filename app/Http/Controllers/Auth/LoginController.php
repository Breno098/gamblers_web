<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
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

            if(Auth::user()->type === 'adm'){
                return redirect()->route('adm.dashboard');
            }
        }

        return redirect('/')->with('error_login', 'Usuário ou senha incorretos.');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        if( !User::create($validatedData)) {
            return redirect('/register')->with('error_register', 'Erro ao se registrar, tente novamente.');
        };

        return redirect()->route('adm.dashboard');

    }



}
