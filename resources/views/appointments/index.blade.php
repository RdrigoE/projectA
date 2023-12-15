<x-app-layout>
    <div class="flex flex-col">
        <a class="self-center mb-4" href="{{ route('appointments.create') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Appointment
            </button>
        </a>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <x-table.table>
                        <x-table.table-head>
                            <x-table.head-item>
                                Job Title
                            </x-table.head-item>
                            <x-table.head-item>
                                Client Name
                            </x-table.head-item>
                            <x-table.head-item>
                                Date
                            </x-table.head-item>
                            <x-table.head-item>
                                Start Time
                            </x-table.head-item>
                            <x-table.head-item>
                                End Time
                            </x-table.head-item>
                            <x-table.head-item>
                                Edit
                            </x-table.head-item>
                            <x-table.head-item>
                                Delete
                            </x-table.head-item>
                        </x-table.table-head>
                        <x-table.table-body>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <x-table.item>
                                        {{ $appointment->job->title }}
                                    </x-table.item>
                                    <x-table.item>{{ $appointment->client->name }}</x-table.item>
                                    <x-table.item>
                                        {{ $appointment->date->format('d/m/Y') }}
                                    </x-table.item>

                                    <x-table.item>
                                        {{ $appointment->start->format('H:i') }}
                                    </x-table.item>

                                    <x-table.item>
                                        {{ $appointment->end->format('H:i') }}
                                    </x-table.item>
                                    <x-table.edit :route="'appointments.edit'" :obj="$appointment" />
                                    <x-table.delete :route="'appointments.destroy'" :obj="$appointment" />
                                </tr>
                            @endforeach
                        </x-table.table-body>
                    </x-table.table>
                    <div class="px-6 py-3">{{ $appointments->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
