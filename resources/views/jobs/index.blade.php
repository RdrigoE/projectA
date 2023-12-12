<x-app-layout>
    <a href="{{ route('jobs.create') }}">Create Job</a>
    <table>
        <thead>
            <th>
                Job Title
            </th>
            <th>
                Actions
            </th>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>
                        <a href="{{ route('jobs.edit', $job->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $jobs->links() }}
</x-app-layout>
