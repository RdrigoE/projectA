<x-app-layout>
    <x-form.panel>
        <x-form.form :method="'POST'" :action="route('jobs.store')">
            @method('POST')
            <x-form.title>Create New Job</x-form.title>
            <x-form.text-input :name="'title'" :value="''" />
            <x-form.submit>
                Submit
            </x-form.submit>
        </x-form.form>
    </x-form.panel>

</x-app-layout>
