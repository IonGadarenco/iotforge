<?php

namespace App\Livewire\Sensor;

use Illuminate\Support\Facades\Cache as FacadesCache;
use Livewire\Component;

class SensorLiveUpdate extends Component
{
    public $deviceId;
    public $temperature;
    public $humedity;

    public function mount($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->fetchData();
    }

    public function fetchData()
    {
        $cacheKey = "device_{$this->deviceId}_sensor_data";
        $latestSensorData = FacadesCache::get($cacheKey);

        if ($latestSensorData) {
            $this->temperature = $latestSensorData['temperature'] ?? 'N/A';
            $this->humedity = $latestSensorData['humedity'] ?? 'N/A';
        } else {
            $this->temperature = 'N/A';
            $this->humedity = 'N/A';
        }
    }
    public function render()
    {
        return view('livewire.sensor.sensor-live-update');
    }
}
