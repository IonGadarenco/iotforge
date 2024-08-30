<?php

namespace App\Livewire\Devices;

use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\Device;

class DevicesIndex extends Component
{
    public $devices;
    public function render(): Factory|Application|View
    {
        $this->devices = Device::all();
        return view('livewire.devices.devices-index');
    }
}
