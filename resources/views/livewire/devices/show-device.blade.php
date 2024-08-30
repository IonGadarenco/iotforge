<div class="m-4 p-6 bg-white rounded-lg shadow-md">
    <!-- Device Details -->
    <div>
        <h1 class="text-2xl font-bold mb-4">Device Details</h1>
        <table class="min-w-full text-left border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b border-gray-200 font-semibold">Attribute</th>
                    <th class="px-4 py-2 border-b border-gray-200 font-semibold">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">ID</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $device->id }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">Name</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $device->name }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">Type</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $device->device_type }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">Device Identifier</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $device->device_identifier }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">Created At</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $device->created_at->toFormattedDateString() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="my-6 border-t border-gray-300">

    <!-- Livewire Component for Sensor Live Update -->
    @livewire('sensor.sensor-live-update', ['deviceId' => $device->id])

    <hr class="my-6 border-t border-gray-300">

    <!-- Sensor Data -->
    @if ($device->sensors->isEmpty())
        <p class="text-red-500">No sensors found for this device.</p>
    @else
        <div>
            @foreach ($device->sensors as $sensor)
                <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-2">Sensor Data</h3>
                    <table class="min-w-full text-left border-collapse">
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 font-semibold">Temperature:</td>
                                <td class="px-4 py-2">{{ $sensor->data['temperature'] ?? 'N/A' }} C</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-semibold">Humidity:</td>
                                <td class="px-4 py-2">{{ $sensor->data['humedity'] ?? 'N/A' }} %</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-semibold">Recorded:</td>
                                <td class="px-4 py-2">{{ $sensor->created_at->format('F j, Y, g:i:s a') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endif
</div>
