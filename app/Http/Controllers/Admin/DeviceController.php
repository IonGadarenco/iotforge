<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class DeviceController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->all();

        $devices = Device::paginate(10);

        return view(
            'admin.devices.index',
            compact('data', 'devices')
        );
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'string|max:255',
        ]);


        $device = new Device();
        $device->translateOrNew('en')->name = $inputs['name'];
        $device->translateOrNew('ro')->name = $inputs['name'];
        $device->translateOrNew('ru')->name = $inputs['name'];
        $device->save();


        return redirect()->route('admin.devices.edit', $device->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {

        return view(
            'admin.devices.edit',
            compact('device')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'ro_name' => 'required|string',
            'ru_name' => 'string|nullable',
            'en_name' => 'string|nullable',
            'ro_funder' => 'string|nullable',
            'ru_funder' => 'string|nullable',
            'en_funder' => 'string|nullable',
            'ro_content' => 'string|nullable',
            'ru_content' => 'string|nullable',
            'en_content' => 'string|nullable',
            'start_date' => 'string|nullable',
            'end_date' => 'string|nullable',
            'budget' => 'integer|nullable',
        ]);


        // Update translations
        $device->translate('ro')->update([
            'name' => $request->input('ro_name'),
            'content' => $request->input('ro_content'),
            'funder' => $request->input('ro_funder'),
        ]);

        $device->translate('en')->update([
            'name' => $request->input('en_name'),
            'content' => $request->input('en_content'),
            'funder' => $request->input('en_funder'),

        ]);

        $device->translate('ru')->update([
            'name' => $request->input('ru_name'),
            'content' => $request->input('ru_content'),
            'funder' => $request->input('ru_funder'),

        ]);

        // Update other device fields if needed
        $device->update([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'budget' => $request->input('budget'),
            'active' => 1
        ]);

        return redirect()->route('admin.devices');
    }


    public function changeStatus(Device $device)
    {
        $device->update(['active' => !$device->active]);

        return back();
    }


    public function destroy(Device $device, Request $request)
    {
        DeleteImage::delete($device);

        $device->delete();
        $request->session()->flash('deleted', 'Proiectul cu id-ul: ' . $device->id . ' a fost ștearsă.');

        return back();
    }

    public function storeImageGeneral(Request $request, Device $device)
    {
        // Validate the uploaded file
        $request->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        // Retrieve the uploaded file
        $file = $request->file('picture');

        // Create an Intervention Image instance
        $image = Image::make($file);

        // Resize the image (e.g., to a width of 800px and auto height)
        $image->resize(410, null, function ($constraint) {
            $constraint->aspectRatio(); // Maintain the aspect ratio
            $constraint->upsize(); // Prevent upsizing if the image is smaller
        });

        // Generate a filename and delete the old file if it exists
        $extension = $file->extension();
        $filename = time();
        Storage::delete('public/' . $device->picture);

        // Save the resized image to the storage
        $image->save(storage_path('app/public/devices/' . $filename . '.' . $extension));

        // Prepare the inputs for updating the device
        $inputs['picture'] = 'devices/' . $filename . '.' . $extension;

        // Update the device
        $device->update($inputs);

        // Return the URL of the stored image
        echo asset('storage/' . $inputs['picture']);
    }


    public function deleteImageGeneral(Device $device)
    {
        DeleteImage::delete($device);
        return back();
    }
}
