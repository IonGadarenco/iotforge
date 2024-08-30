<div>
    <div>
        <h1>Device Details</h1>
        <ul>
            <li>ID: {{$device->id}}</li>
            <li>Name: {{$device->name}}</li>
            <li>Type: {{$device->device_type}}</li>
            <li>Device Identifier: {{$device->device_identifier}}</li>
            <li>Created At: {{$device->created_at->toFormattedDateString()}}</li>
        </ul>
    </div>

    <hr>
    @livewire('sensor.sensor-live-update', ['deviceId' => $device->id])
    <hr>

    @if ($device->sensors->isEmpty())
        <p>No sensors found for this device.</p>
    @else
        <div>
            @foreach ($device->sensors as $sensor)
                <div>
                    <hr>
                    <h3>Sensor Data: </h3>
                    <div>
                        <p><strong>Temperature: </strong>{{$sensor->data['temperature'] ?? 'N/A'}} C</p>
                        <p><strong>Humedity: </strong>{{$sensor->data['humedity'] ?? 'N/A'}} %</p>
                        <p><strong>Recorded: </strong>{{$sensor->created_at->format('F j, Y, g:i:s a')}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
