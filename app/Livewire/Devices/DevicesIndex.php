<?php

namespace App\Livewire\Devices;

use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\Device;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class DevicesIndex extends Component
{
    public $devices;

    #[On('refreshDevices')]
    public function updateDeviceList()
    {
        $this->devices = Device::all();
    }
    public function deleteDevice($id)
    {
        $device = Device::findOrFail($id);
        if ($device) {
            $device->delete();
        }
    }
    public function render(): Factory|Application|View
    {
        $this->devices = Device::all();
        return view('livewire.devices.devices-index');
    }
}
