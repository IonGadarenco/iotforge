<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    public function index()
    {
        return view('device.index');
    }

    public function edit($id)
    {
        $users = User::all();
        $device = Device::findOrFail($id);
        return view('device.edit', compact("device", 'users'));
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        return view('device.show', compact("device"));
    }
    public function delete($id)
    {
        $device = Device::findOrFail($id);
        if ($device) {
            $device->delete();
        }
        return redirect()->back();
    }
    public function update(Request $request, Device $device)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:255',
            'device_type' => 'nullable|string|max:255',
            'device_identifier' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $device->update($inputs);
        Log::info($device);

        return redirect()->route('device.index')->with('success', 'Device updated successfully!');
    }
}
