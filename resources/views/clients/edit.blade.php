<x-app-layout>
    <x-form.panel>
        <x-form.form :method="'POST'" :action="route('clients.update', $client)">
            @method('patch')
            <x-form.title>Edit the Client</x-form.title>
            <x-form.text-input :name="'name'" :value="$client->name" />
            <x-form.submit>
                Update
            </x-form.submit>
        </x-form.form>
    </x-form.panel>
</x-app-layout>
