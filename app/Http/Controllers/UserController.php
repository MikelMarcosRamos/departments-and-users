<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
    
        User::create($data);
    
        return redirect()->route('users.index')
            ->with('message', 'User created!');
    }

    function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.edit', compact('user'));
    }

    function update(Request $request, $userId)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($userId);

        if ($user->email !== $data['email']) {
            $request->validate([
                'email' => 'required|email|unique:users',
            ]);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        
        return redirect(route('users.index'))
            ->with('message', 'User edited!');
    }

    function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect(route('users.index'))
            ->with('message', 'User deleted!');
    }
}
