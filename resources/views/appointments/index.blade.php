<x-app-layout>
    <a href="{{ route('appointments.create') }}">Create Job</a>
    <table>
        <thead>
            <th>
                Job
            </th>
            <th>
                Client
            </th>
            <th>
                Start
            </th>
            <th>
                End
            </th>
            <th>
                Actions
            </th>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->job->title }}</td>
                    <td>{{ $appointment->client->name }}</td>
                    <td>{{ $appointment->start->format('d/m/Y H:i') }}</td>
                    <td>{{ $appointment->end->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $appointments->links() }}
</x-app-layout>
