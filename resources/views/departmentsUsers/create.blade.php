@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">Add User to Department: {{ $department->name }}</h2>
    <form method="POST" action="{{ route('departments.store') }}" class="p-2">
        @csrf
        <div class="sm:col-span-3">
            <label for="user" class="block text-sm font-medium leading-6 text-gray-900">Users</label>
            <div class="mt-2">
                <select id="user" name="user" autocomplete="user"
                class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
@endsection
