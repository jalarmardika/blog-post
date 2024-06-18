<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function login(Request $request)
	{
		$credential = $request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

		if (Auth::attempt($credential)) {
			if(auth()->user()->is_admin == 0){
				$request->session()->regenerate();
				return redirect()->intended('/');
			}else{
				$request->session()->regenerate();
				return redirect()->intended('/');
			}
		}
		return back()->with('error','Login Failed');
	}

	public function logout()
	{
		Auth::logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();
		return redirect('/');
	}
}
