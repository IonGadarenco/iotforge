<?php

namespace App\Livewire\Devices;

use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\Device;
use Livewire\Attributes\On;

class DevicesIndex extends Component
{
    public $devices;
    public function render(): Factory|Application|View
    {
        $this->devices = Device::all();
        return view('livewire.devices.devices-index');
    }

    #[On("refreshDevices")]
    public function updateDevicesList()
    {
        $this->devices = Device::all();
    }

    public function deleteDevice($id): Factory|Application|View
    {
        $device = Device::findOrFail($id);
        if($device){
            $device->delete();
        }
        return view('livewire.devices.devices-index');
    }
}
