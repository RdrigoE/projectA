@vite(['resources/css/app.css', 'resources/js/calendar.js'])
<x-app-layout>
    <div
        class="mx-auto  bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white rounded">

        <div class="flex justify-center space-x-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="month">Month
                View</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="week">Week
                View</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="day">Day
                View</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                id="today">Today</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                id="prev">Prev</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                id="next">Next</button>
        </div>
        <div id="currentDate" class="text-center text-white text-2xl font-bold m-2"></div>

        <div id="calendar" class="h-[80vh] bg-white shadow p-4"></div>

    </div>
</x-app-layout>
