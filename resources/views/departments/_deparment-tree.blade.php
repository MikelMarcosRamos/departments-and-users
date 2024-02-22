<li>
    <code class="relative flex items-end">
        <div class="flex-1 flex items-center">
            {{ $department->name }}
            <a href="{{ route('departments.edit', $department->id) }}" title="Edit"
                class="h-8 w-8 select-none rounded flex items-center justify-center text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true" class="w-4 h-4">
                    <path
                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                    </path>
                </svg>
            </a>
            <form method="POST" action="{{ route('departments.destroy', $department->id) }}"
                onsubmit="return confirm('Are you sure you want to delete the department?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="h-8 w-8 select-none rounded flex items-center justify-center text-red-500 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 30 30" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </code>
    @if (count($department->children) > 0)
        <ul>
            @foreach ($department->children as $child)
                @include('departments._deparment-tree', ['department' => $child])
            @endforeach
        </ul>
    @endif
</li>