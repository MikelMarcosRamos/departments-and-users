<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    function index()
    {
        $departments = Department::with('children')->whereNull('department_id')->get();
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

    function edit($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $departments = Department::all();
        return view('departments.edit', compact('department', 'departments'));
    }

    function update(Request $request, $departmentId)
    {
        $data = $request->validate([
            'name' => 'required',
            'department_id' => 'nullable'
        ]);

        $department = Department::findOrFail($departmentId);

        $department->name = $data['name'];
        $department->save();

        return redirect(route('departments.index'))
            ->with('message', 'Department edited!');
    }

    function destroy($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $department->delete();

        return redirect(route('departments.index'))
            ->with('message', 'Department deleted!');
    }
}
