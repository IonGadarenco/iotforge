<div>
    <div class="overflow-x-auto my-5">
        <table class="min-w-full divide-y divide-gray-300 border border-gray-300 bg-transparent">
            <thead class="bg-gray-800">
                <tr>
                    <th class="py-3 px-6 text-sm font-semibold text-white">ID</th>
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
                        <td class="py-3 px-6 text-white">{{ $device->user->name }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->device_type }}</td>
                        <td class="py-3 px-6 text-white">{{ $device->device_identifier }}</td>
                        <td class="py-3 px-6 text-white">
                            <a href="{{ route('device.show', $device->id) }}"
                                class="text-white hover:text-indigo-300 mr-4"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('device.edit', $device->id) }}"
                                class="text-white hover:text-indigo-300 mr-4"><i class="bi bi-pencil-square"></i></a>
                            <a wire:click="deleteDevice({{ $device->id }})"
                                class="text-danger hover:text-red-500">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
