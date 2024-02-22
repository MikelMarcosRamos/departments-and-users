@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center p-4">
        <h2 class="text-4xl font-extrabold dark:text-white">Departments</h2>
        <a href="{{ route('departments.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Department</a>
    </div>
    @include('layouts.partials._message')
    <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        No departments.
    </div>
@endsection