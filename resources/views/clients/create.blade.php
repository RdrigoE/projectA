<x-app-layout>

    <form method="post" action="{{ route('clients.store') }}">
        @csrf
        @method('POST')
        <div>
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name">
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
