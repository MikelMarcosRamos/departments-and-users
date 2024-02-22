<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartmentUserController extends Controller
{
    function create()
    {
        $departments = Department::all();
        return view('departments.create', compact('departments'));
    }
}
