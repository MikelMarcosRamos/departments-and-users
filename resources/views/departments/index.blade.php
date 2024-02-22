@extends('layouts.app')

@push('styles')
    <style>
        .tree,
        .tree ul,
        .tree li {
            list-style: none;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .tree {
            margin: 0 0 1em;
            text-align: center;
        }

        .tree,
        .tree ul {
            display: table;
        }

        .tree ul {
            width: 100%;
        }

        .tree li {
            display: table-cell;
            padding: .5em 0;
            vertical-align: top;
        }

        /* _________ */
        .tree li:before {
            outline: solid 1px #666;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .tree li:first-child:before {
            left: 50%;
        }

        .tree li:last-child:before {
            right: 50%;
        }

        .tree code,
        .tree span {
            border: solid .1em #666;
            border-radius: .2em;
            display: inline-block;
            margin: 0 .2em .5em;
            padding: .2em .5em;
            position: relative;
        }

        /* If the tree represents DOM structure */
        .tree code {
            font-family: monaco, Consolas, 'Lucida Console', monospace;
        }

        /* | */
        .tree ul:before,
        .tree code:before,
        .tree span:before {
            outline: solid 1px #666;
            content: "";
            height: .5em;
            left: 50%;
            position: absolute;
        }

        .tree ul:before {
            top: -.5em;
        }

        .tree code:before,
        .tree span:before {
            top: -.55em;
        }

        /* The root node doesn't connect upwards */
        .tree>li {
            margin-top: 0;
        }

        .tree>li:before,
        .tree>li:after,
        .tree>li>code:before,
        .tree>li>span:before {
            outline: none;
        }
    </style>
@endpush

@section('content')
    <div class="flex justify-between items-center p-4">
        <h2 class="text-4xl font-extrabold dark:text-white">Departments</h2>
        <a href="{{ route('departments.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Department</a>
    </div>
    @include('layouts.partials._message')
    <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
        @if ($departments->isEmpty())
            No departments.
        @else
            <ul class="tree">
                @foreach ($departments as $department)
                    @include('departments._deparment-tree', ['department' => $department])                    
                @endforeach
            </ul>
        @endif
    </div>
    <a href="https://medium.com/@ross.angus/sitemaps-and-dom-structure-from-nested-unordered-lists-eab2b02950cf" 
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tree source</a>
@endsection
