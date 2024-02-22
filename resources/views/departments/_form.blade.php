<div class="pb-12">
    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
    <div class="mt-2">
        <input type="text" name="name" id="name" autocomplete="name"
            value="{{ old('name', $department->name ?? '') }}" required
            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        @error('name')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="sm:col-span-3">
        <label for="department_id" class="block text-sm font-medium leading-6 text-gray-900">Parent</label>
        <div class="mt-2">
            <select id="department_id" name="department_id" autocomplete="department_id"
                class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option value=''>...</option>
                @foreach ($departments as $parentDepartment)
                    <option value="{{ $parentDepartment->id }}" @if ($parentDepartment->id === old('department_id', $department->department_id ?? '')) selected @endif>
                        {{ $parentDepartment->name }}</option>
                @endforeach
            </select>
            @error('department_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('departments.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
    <button type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
</div>