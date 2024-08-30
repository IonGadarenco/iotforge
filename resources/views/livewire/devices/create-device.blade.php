<form wire:submit.prevent="submit" class="space-y-4">
    <div>
        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
        <select wire:model="user_id" id="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Select a user</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Device Name</label>
        <input type="text" wire:model.lazy="name" autocomplete="off" id="name" placeholder="Device Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="device_type" class="block text-sm font-medium text-gray-700">Device Type</label>
        <input type="text" autocomplete="off" wire:model.lazy="device_type" id="device_type" placeholder="Device Type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('device_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-between space-x-4">
        <button style="background-color: rgb(26, 106, 219)" type="submit" @click="showModal = false" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Save Device
        </button>
        <button style="background-color: rgb(219, 78, 26)" type="button" @click="showModal = false" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Cancel
        </button>
    </div>
</form>
