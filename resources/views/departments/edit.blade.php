@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">Edit Department</h2>
    @include('layouts.partials._message')
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
        @if ($department->users->count() === 0)
            <p class="mt-2">No users.</p>
        @else
            <div class="mt-2">
                <form method="POST" action="{{ route('departmentsUsers.destroy', $department->id) }}"
                    onsubmit="return confirm('Are you sure you want to detach selected user?')"
                    class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <select id="user_id" name="user_id" autocomplete="user_id"
                        class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        @foreach ($department->users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="ml-2 rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Detach</button>

                </form>
            </div>
        @endif
    </div>
@endsection
