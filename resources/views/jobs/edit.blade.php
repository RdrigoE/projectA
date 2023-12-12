<x-app-layout>

    <form method="post" action="{{ route('jobs.update', $job) }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title" value="{{ $job->title }}">
        </div>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
