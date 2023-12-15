<x-app-layout>
    <x-form.panel>
        <x-form.form :method="'POST'" :action="route('jobs.update', $job)">
            @method('patch')
            <x-form.title>Edit the Job - {{ $job->title }}</x-form.title>
            <x-form.text-input :name="'title'" :value="old('title') ? old('title') : $job->title" />
            <x-form.submit>
                Update
            </x-form.submit>
        </x-form.form>
    </x-form.panel>
</x-app-layout>
