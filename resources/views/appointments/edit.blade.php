<x-app-layout>

    <form method="post" action="{{ route('appointments.update', $appointment) }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="job_id">Job</label>
            <select name="job_id" id="job_id">
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }} {{ old($appointment->job->is($job)) ? 'selected' : '' }}">
                        {{ $job->title }}
                    </option>
                @endforeach
            </select>
            @error('job_id')
                <div>{{ $message }}</div>
            @enderror

            <label for="client_id">Client</label>
            <select name="client_id" id="client_id">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }} {{ old($appointment->client->is($client)) ? 'selected' : '' }}">
                        {{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <div>{{ $message }}</div>
            @enderror

            <label for="start">Start</label>
            <input type="datetime-local" value="{{ $appointment->start }}" name="start" id="start">
            @error('start')
                <div>{{ $message }}</div>
            @enderror

            <label for="end">End</label>
            <input type="datetime-local" value="{{ $appointment->end }}" name="end" id="end">
            @error('end')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Save</button>
    </form>

</x-app-layout>
