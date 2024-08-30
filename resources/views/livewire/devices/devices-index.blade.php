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
                            <a href="{{ route('device.show', $device->id) }}" class="text-indigo-400 hover:text-indigo-300 mr-4">View</a>
                            <a href="{{ route('device.edit', $device->id) }}" class="text-indigo-400 hover:text-indigo-300">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
