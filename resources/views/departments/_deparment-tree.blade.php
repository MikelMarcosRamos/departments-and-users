<li>
    <code>{{ $department->name }}</code>
    @if (count($department->children) > 0)
        <ul>
            @foreach ($department->children as $child)
                @include('departments._deparment-tree', ['department' => $child])
            @endforeach
        </ul>
    @endif
</li>