<x-app-layout>

    <form method="post" action="{{ route('clients.update', $client) }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name" value="{{ $client->name }}">
        </div>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
