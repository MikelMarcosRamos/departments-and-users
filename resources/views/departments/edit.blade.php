@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">Edit Department</h2>
    <form method="POST" action="{{ route('departments.update', $department->id) }}" class="p-2">
        @csrf
        @include('departments._form')
    </form>
@endsection
