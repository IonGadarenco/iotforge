<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteImage
{
    public static function delete($element)
    {

        try {
            if ($element->picture) {
                Log::info('Attempting to delete image: ' . $element->picture);

                $disk = 'public'; // Adjust according to your setup
                $filePath = str_replace('/storage', '', $element->picture); // Adjust path if necessary

                if (Storage::disk($disk)->exists($filePath)) {
                    Storage::disk($disk)->delete($filePath);
                    Log::info('Image deleted successfully from storage: ' . $filePath);
                } else {
                    Log::warning('File does not exist in storage: ' . $filePath);
                    request()->session()->flash('error', 'File does not exist in storage');
                }
                $element->picture = null;

            }
            if ($element->picture_small) {
                Log::info('Attempting to delete image: ' . $element->picture_small);

                $disk = 'public'; // Adjust according to your setup
                $filePath = str_replace('/storage', '', $element->picture_small); // Adjust path if necessary

                if (Storage::disk($disk)->exists($filePath)) {
                    Storage::disk($disk)->delete($filePath);
                    Log::info('Image deleted successfully from storage: ' . $filePath);
                } else {
                    Log::warning('File does not exist in storage: ' . $filePath);
                    request()->session()->flash('error', 'File does not exist in storage');
                }
                $element->picture_small = null;

            }

            $element->save();
           // dd($element);
            Log::info('Database updated, picture attribute cleared for news ID: ' . $element->id);

            request()->session()->flash('success', 'Imaginea de bază a fost ștersă');
        } catch (\Exception $e) {
            Log::error('Error deleting image from storage: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            request()->session()->flash('error', 'An error occurred while deleting the image.');
        }
    }

}
