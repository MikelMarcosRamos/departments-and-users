<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;

class DepartmentUserController extends Controller
{
    function create($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $users = User::all();
        return view('departmentsUsers.create', compact('department', 'users'));
    }
}
