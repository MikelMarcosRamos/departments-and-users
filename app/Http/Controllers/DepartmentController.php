<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Rules\ParentCanNotBeDescendant;

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
        $departments = $department->possibleParents();
        return view('departments.edit', compact('department', 'departments'));
    }

    function update(Request $request, $departmentId)
    {
        $department = Department::findOrFail($departmentId);

        $data = $request->validate([
            'name' => 'required',
            'department_id' => [
                'nullable',
                new ParentCanNotBeDescendant($department)
            ]
        ]);

        $department->name = $data['name'];
        $department->department_id = $data['department_id'] ?? null;
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
