<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'users' => User::latest()->get()
        ]);
    }

    public function profile()
    {
        return view('user.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255|min:5'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        if ($request->is_admin) {
            $validatedData['is_admin'] = 1;
        }

        User::create($validatedData);
        return redirect('user')->with('success', 'Data Saved Successfully');
    }

    public function editProfile(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users|max:255';
        }

        if ($request->password) {
            $rules['password'] = 'max:255|min:5';
        }

        $validatedData = $request->validate($rules);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);
        return redirect('profile')->with('success', 'Profile Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users|max:255';
        }

        if ($request->password) {
            $rules['password'] = 'max:255|min:5';
        }

        $validatedData = $request->validate($rules);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        if ($request->is_admin) {
            $validatedData['is_admin'] = 1;
        }else{
            $validatedData['is_admin'] = 0;
        }

        User::where('id', $user->id)->update($validatedData);
        return redirect('user')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
            return redirect('user')->with('success', 'Data Deleted Successfully');
        } catch (QueryException $e) {
            return redirect('user')->with('failed', 'Data cannot be deleted because there is related posts data');
        }
    }
}
