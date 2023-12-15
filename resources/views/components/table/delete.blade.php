@props(['route', 'obj'])
<td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
    <form action="{{ route($route, $obj) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
    </form>
</td>
