<x-app-layout>
    <div class="flex flex-col">
        <a class="self-center mb-4" href="{{ route('jobs.create') }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Job
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
                                Edit
                            </x-table.head-item>
                            <x-table.head-item>
                                Delete
                            </x-table.head-item>
                        </x-table.table-head>
                        <x-table.table-body>
                            @foreach ($jobs as $job)
                                <tr>
                                    <x-table.item>
                                        {{ $job->title }}
                                    </x-table.item>
                                    <x-table.edit :route="'jobs.edit'" :obj="$job" />
                                    <x-table.delete :route="'jobs.destroy'" :obj="$job" />
                                </tr>
                            @endforeach
                        </x-table.table-body>
                    </x-table.table>
                    <div class="px-6 py-3">{{ $jobs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
