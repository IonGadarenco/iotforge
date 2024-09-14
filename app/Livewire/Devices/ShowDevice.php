<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowDevice extends Component
{
    public $deviceId, $device;

    public function render()
    {
        return view('livewire.devices.show-device', ['device' => $this->device]);
    }
}
