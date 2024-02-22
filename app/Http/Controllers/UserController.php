<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    function index()
    {
        return view('users.index');
    }
}
