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
