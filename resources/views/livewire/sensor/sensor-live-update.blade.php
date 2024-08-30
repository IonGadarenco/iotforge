<div>
    <div wire:poll.1500ms="fetchData" style="background-color:{{$temperature > 23 ? 'red' : 'green'}}">
        <h2>Live Sensor Data</h2>
        <p>Temperature: {{$temperature}} C</p>
        <p>Humedity: {{$humedity}} %</p>
    </div>
</div>
