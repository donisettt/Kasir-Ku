<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = User::select('id', 'nama', 'username', 'role')
            ->when($search, function ($q, $search) {
                return $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->orderBy('id')
            ->paginate(50);

        return view('user.index', [
            'data' => $data
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:4',
            'username' => 'required|min:4|alpha_dash|unique:users',
            'role' => 'required|in:manajer,kasir',
            'password' => 'required|min:4'
        ]);
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        User::create($request->all());
        return to_route('user.index')->with('status', 'save');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users)
    {
        return view('user.edit', [
            'row' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|min:4',
            'username' => 'required|min:4|alpha_dash|unique:users,username,' . $user->id,
            'role' => 'required|in:manajer,kasir',
            'password' => 'nullable|min:4'
        ]);

        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            $user->update($request->all());
        } else {
            $user->update($request->except(['password']));
        }
        return to_route('user.index')->with('status', 'edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'delete');
    }
}