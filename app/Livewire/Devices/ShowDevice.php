<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;

class ShowDevice extends Component
{
    public $deviceId, $device;

    public function mount($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->device = Device::with('sensors')->findOrFail($this->deviceId);
    }
    public function render()
    {
        return view('livewire.devices.show-device', ['device' => $this->device]);
    }
}
