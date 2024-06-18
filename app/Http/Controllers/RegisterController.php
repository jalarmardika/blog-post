<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255|min:5'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('login')->with('success','Registration Successfully');
    }

}
