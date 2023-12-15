@props(['method', 'action'])
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method={{ $method }} action="{{ $action }}">
    @csrf
    {{ $slot }}

</form>
