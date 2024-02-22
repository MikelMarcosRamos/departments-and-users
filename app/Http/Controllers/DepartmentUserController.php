<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentUserController extends Controller
{
    function create($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $users = User::all();
        return view('departmentsUsers.create', compact('department', 'users'));
    }

    function store(Request $request, $departmentId)
    {
        $department = Department::findOrFail($departmentId);

        $data = $request->validate([
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($data['user_id']);
        $department->users()->attach($user->id);

        return redirect(route('departments.edit', $departmentId))
            ->with('message', 'User added!');
    }
}
