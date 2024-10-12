<x-app-layout>
    <div class= "col-6 m-4 p-4 bg-white rounded-lg shadow-md bg-gradient-to-r from-blue-500 to-teal-500">
        <!-- Device Details -->

        <form method="POST" action="{{ route('device.update', $device->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="user_id" class="block text-sm font-medium text-white">User</label>
                <select name="user_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $device->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-white">Device Name</label>
                <input type="text" name="name" autocomplete="off" id="name" placeholder="Device Name"
                    value="{{ old('name', $device->name) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="device_type" class="block text-sm font-medium text-white">Device Type</label>
                <input type="text" autocomplete="off" name="device_type" id="device_type"
                    value="{{ old('device_type', $device->device_type) }}" placeholder="Device Type"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('device_type')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="device_identifier" class="block text-sm font-medium text-white">Device identifier</label>
                <input type="text" autocomplete="off" name="device_identifier" id="device_identifier"
                    value="{{ old('device_identifier', $device->device_identifier) }}" placeholder="Device Type"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('device_identifier')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-between space-x-4">

                <button type="button" onclick="window.location='{{ route('device.index') }}'"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Device
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
