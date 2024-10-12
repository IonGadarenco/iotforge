<?php

namespace App\Livewire\Devices;

use Livewire\Component;
use App\Models\Device;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class DevicesIndex extends Component
{
    use WithPagination;
    public $search;

    #[On('refreshDevices')]
    public function updateDeviceList() {}

    public function deleteDevice($id)
    {
        $device = Device::findOrFail($id);
        if ($device) {
            $device->delete();
        }
    }
    public function render()
    {
        $devices = Device::orderByDesc('id')->where('name', 'LIKE', "%{$this->search}%")->paginate(10);
        return view('livewire.devices.devices-index', compact('devices'));
    }
}
