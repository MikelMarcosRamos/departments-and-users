@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">Add User to Department: {{ $department->name }}</h2>
    <form method="POST" action="{{ route('departmentsUsers.store', $department->id) }}" class="p-2">
        @csrf
        <div class="sm:col-span-3">
            <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">Users</label>
            <div class="mt-2">
                <select id="user_id" name="user_id" autocomplete="user_id"
                class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('departments.edit', $department->id) }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
        </div>
    </form>
@endsection
