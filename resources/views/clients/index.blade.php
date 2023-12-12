<x-app-layout>
    <a href="{{ route('clients.create') }}">Create Client</a>
    <table>
        <thead>
            <th>
                Name
            </th>
            <th>
                Actions
            </th>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>
                        <a href="{{ route('clients.edit', $client->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $clients->links() }}
</x-app-layout>
