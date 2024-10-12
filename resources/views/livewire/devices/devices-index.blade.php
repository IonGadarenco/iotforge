<div>
    <div class="overflow-x-auto my-3">

        <div class="relative my-2">
            <input type="text" wire:model.live.debounce.500ms="search"
                class="border rounded-lg pl-10 pr-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search...">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4a7 7 0 105.293 12.293l4.25 4.25a1 1 0 001.415-1.415l-4.25-4.25A7 7 0 0011 4z" />
            </svg>
        </div>
        <table class="min-w-full divide-y divide-gray-300 border border-gray-300 bg-transparent">
            <thead class="bg-gray-800">
                <tr>
                    <th class="py-3 px-6 text-sm font-semibold text-white">ID</th>
                    <th class="py-3 px-6 text-sm font-semibold text-white">Name</th>
                    <th class="py-3 px-6 text-sm font-semibold text-white">User</th>
                    <th class="py-3 px-6 text-sm font-semibold text-white">Device Type</th>
                    <th class="py-3 px-6 text-sm font-semibold text-white">Device Identifier</th>
                    <th class="py-3 px-6 text-sm font-semibold text-white">Action</th>
                </tr>
            </thead>
            <tbody class="bg-transparent divide-y divide-gray-200">
                @foreach ($devices as $device)
                    <tr class="hover:bg-gray-800">
                        <td class="py-3 px-6 text-white">{{ $device->id }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->name }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->user->name }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->device_type }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->device_identifier }}</td>
                        <td class="py-3 px-6 text-white">
                            <a href="{{ route('device.show', $device->id) }}"
                                class="text-white hover:text-indigo-300 mr-4"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('device.edit', $device->id) }}"
                                class="text-white hover:text-indigo-300 mr-4"><i class="bi bi-pencil-square"></i></a>
                            <a x-data="{ id: {{ $device->id }} }"
                                @click.prevent="if (confirm('Are you sure you want to delete this device?')) { $wire.deleteDevice(id) }"
                                class="text-danger hover:text-red-500">
                                <i class="bi bi-trash"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-3">
            {{ $devices->links() }}

        </div>

    </div>
</div>
