@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">Edit Department</h2>
    <form method="POST" action="{{ route('departments.update', $department->id) }}" class="p-2">
        @csrf
        @include('departments._form')
    </form>
    <div class="border-t border-gray-300 my-6 p-2">
        <div class="flex justify-between items-center p-4">
            <h3 class="text-2xl font-extrabold dark:text-white">User List</h3>
            <a href="{{ route('departmentsUsers.create', $department->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-2 text-sm font-semibold rounded">Add User</a>
        </div>
        <p class="mt-2">No users.</p>
    </div>
@endsection
