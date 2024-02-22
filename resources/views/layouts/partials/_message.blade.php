@if (session('message'))
    <div class="bg-green-500 border border-green-400 text-white px-4 py-3 rounded relative animated fadeInDown" role="alert">
        {{ session('message') }}
    </div>
@endif