<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function settings()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.\Auth::user()->id
        ]);

        \Auth::user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $success = 'User settings updated';
        return redirect('/user/settings')->with('success', $success);
    }
    public function delete()
    {
        \Auth::user()->delete();
        return redirect()->away(env('APP_URL'));
    }
}
