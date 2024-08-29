<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', [
            'row' => $user
        ]);
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'row' => $user
        ]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nama' => ['required', 'min:4'],
            'username' => ['required', 'min:4', 'alpha_dash', "unique:users,username,{$user->id}"],
            'password' => ['nullable', 'min:4', 'confirmed']
        ], [], [
            'password' => 'Password baru'
        ]);
        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            $user->update($request->all());
        } else {
            $user->update($request->except(['password']));
        }
        return to_route('profile.index')->with('status', 'edit');
    }
}