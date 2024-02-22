@extends('layouts.app')
@section('content')
    <h2 class="text-4xl font-extrabold dark:text-white">New User</h2>
    <form method="POST" action="{{route('users.store')}}" class="p-2">
        @csrf
        @include('users._form')
    </form>
@endsection
