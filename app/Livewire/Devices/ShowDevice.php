<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;

class ShowDevice extends Component
{
    public $deviceId;

    public function render()
    {
        $device = Device::find($this->deviceId);
        return view('livewire.devices.show-device', ['device' => $device]);
    }
}
