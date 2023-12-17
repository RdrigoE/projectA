<x-form.panel>
    <x-form.form :method="'POST'" :action="route('appointments.store')">
        <x-form.title>Create New Appointment</x-form.title>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="client_id">Client</label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="client_id" id="client_id">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                    <option value="{{ $job->id }}">{{ $job->title }}</option>
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
                type="date" name="date" id="date">
            @error('date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="start">Start</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="time" name="start" id="start" step="any">
            @error('start')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="end">End</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="time" name="end" id="end" step="any">
            @error('end')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Save
            </button>

            <button data-close-modal
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button">
                Cancel
            </button>
        </div>
    </x-form.form>
</x-form.panel>

<script>
    const form = document.querySelector('form');
    const client_id = document.querySelector('#client_id');
    const job_id = document.querySelector('#job_id');
    const date = document.querySelector('#date');
    const start = document.querySelector('#start');
    const end = document.querySelector('#end');
    const csrf_token = document.querySelector('meta[name="_csrf_header"]').getAttribute('content');


    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('_token', csrf_token);
        formData.append('client_id', client_id.value);
        formData.append('job_id', job_id.value);
        formData.append('date', date.value);
        formData.append('start', start.value);
        formData.append('end', end.value);
        fetch('/appointments', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                console.log('Appointment created');
                calendar.createEvents([{
                    // random id
                    id: String(Math.random() * 100000000000000000),
                    title: client_id.options[client_id.selectedIndex].text + ' - ' + job_id
                        .options[job_id
                            .selectedIndex].text,
                    start: start.value,
                    end: end.value,
                    allDay: false,
                    resourceEditable: true,
                    durationEditable: true,
                    overlap: true,
                    rendering: 'background',
                    color: '#ff9f89',
                    textColor: '#000000',
                    editable: true,
                    startEditable: true,
                    durationEditable: true,
                    extendedProps: {
                        client_id: client_id.value,
                        job_id: job_id.value,
                        date: date.value,
                        start: start.value,
                        end: end.value,
                    }
                }]);
                modal = document.querySelector('[data-modal-new]');
                modal.close();
                calendar.render()
            }
        });
    });
</script>
