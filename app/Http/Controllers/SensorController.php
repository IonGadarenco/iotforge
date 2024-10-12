<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as FacadesCache;

class SensorController extends Controller
{
    public function store(Request $request, $deviceId)
    {
        $request->validate([
            "data" => "required|array"
        ]);

        $device = Device::findorFail($deviceId);
        $data = $request->data;

        $cacheKey = "device_{$deviceId}_sensor_data";
        FacadesCache::put($cacheKey, $data, now()->addSeconds(4));

        if (isset($data['temperature']) && $data['temperature'] >= 50) {
            $sensor = new Sensor([
                "device_id" => $device->id,
                "data" => $data
            ]);
            $sensor->save();

            return response()->json([
                "message" => "Hight temperature recorded, data saved.",
                "sensor" => $sensor
            ]);
        }



        return response()->json([
            "message" => "Data received and cached, no critical acction needed.",
        ]);
    }
}
