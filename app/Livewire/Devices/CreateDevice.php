<?php

namespace App\Livewire\Devices;

use Livewire\Component;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Str;


class CreateDevice extends Component
{
    public $users, $name, $device_type, $device_identifier, $user_id;

    public function mount()
    {
        $this->users = User::all();
    }

    public function submit()
    {
        $this->validate([
            "name" => "required|string|max:225",
            "device_type" => "required|string|max:225",
            "user_id" => "required|exists:users,id"
        ]);

        Device::create([
            "user_id" => $this->user_id,
            "name" => $this->name,
            "device_type" => $this->device_type,
            "device_identifier" => Str::uuid()
        ]);

        $this->dispatch("refreshDevices");

        $this->reset("name", "device_type", "device_identifier", "user_id");
    }
    public function render()
    {
        return view('livewire.devices.create-device');
    }
}
