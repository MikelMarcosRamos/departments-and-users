<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    function create()
    {
        $departments = Department::all();
        return view('departments.create', compact('departments'));
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'department_id' => 'nullable'
        ]);

        Department::create($data);

        return redirect(route('departments.index'))
            ->with('message', 'Department created!');
    }
}
