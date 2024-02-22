<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    function index()
    {
        return view('departments.index');
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

        return redirect(route('departments.index'))
            ->with('message', 'Department created!');
    }
}
