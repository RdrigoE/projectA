<x-app-layout>
    <x-form.panel>
        <x-form.form :method="'POST'" :action="route('appointments.update', $appointment)">
            @method('patch')
            <x-form.title>Edit Appointment</x-form.title>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="client_id">Client</label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="client_id" id="client_id">
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $appointment->client->is($client) ? 'selected' : '' }}>
                            {{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="job_id">Job</label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="job_id" id="job_id">
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" {{ $appointment->job->is($job) ? 'selected' : '' }}>
                            {{ $job->title }}
                        </option>
                    @endforeach
                </select>
                @error('job_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="date" name="date" id="date" value="{{ $appointment->date->format('Y-m-d') }}">
                @error('date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="start">Start</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="time" name="start" id="start" step="any"
                    value="{{ $appointment->start->format('H:i') }}">
                @error('start')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="end">End</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="time" name="end" id="end" step="any"
                    value="{{ $appointment->end->format('H:i') }}">
                @error('end')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Save
                </button>
            </div>
        </x-form.form>
    </x-form.panel>
</x-app-layout>
