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
        return view('departments.create');
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Department::create($data);

        return redirect(route('departments.index'))
            ->with('message', 'Department created!');
    }
}
