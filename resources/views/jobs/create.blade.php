<x-app-layout>

    <form method="post" action="{{ route('jobs.store') }}">
        @csrf
        @method('POST')
        <div>
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title">
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
