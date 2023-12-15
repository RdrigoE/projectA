<x-app-layout>
    <div class="flex flex-col">
        <a class="self-center mb-4" href="{{ route('clients.create') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Client
            </button>
        </a>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <x-table.table>
                        <x-table.table-head>
                            <x-table.head-item>
                                Client Name
                            </x-table.head-item>
                            <x-table.head-item>
                                Edit
                            </x-table.head-item>
                            <x-table.head-item>
                                Delete
                            </x-table.head-item>
                        </x-table.table-head>
                        <x-table.table-body>
                            @foreach ($clients as $client)
                                <tr>
                                    <x-table.item>
                                        {{ $client->name }}
                                    </x-table.item>
                                    <x-table.edit :route="'clients.edit'" :obj="$client" />
                                    <x-table.delete :route="'clients.destroy'" :obj="$client" />
                                </tr>
                            @endforeach
                        </x-table.table-body>
                    </x-table.table>
                    <div class="px-6 py-3">{{ $clients->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
