<?php

namespace App\Http\Controllers;

class DepartmentController extends Controller
{
    function index()
    {
        return view('departments.index');
    }
}