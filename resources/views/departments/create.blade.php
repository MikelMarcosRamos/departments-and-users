@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">New Department</h2>
    <form method="POST" action="{{ route('departments.store') }}" class="p-2">
        @csrf
        @include('departments._form')
    </form>
@endsection
