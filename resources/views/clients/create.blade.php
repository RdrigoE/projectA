<x-app-layout>

    <x-form.panel>
        <x-form.form :method="'POST'" :action="route('clients.store')">
            @method('POST')
            <x-form.title>Create New Client</x-form.title>
            <x-form.text-input :name="'name'" :value />
            <x-form.submit>
                Submit
            </x-form.submit>
        </x-form.form>
    </x-form.panel>

</x-app-layout>
