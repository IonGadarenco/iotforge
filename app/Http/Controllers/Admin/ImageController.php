<?php

namespace App\Http\Controllers\Admin;

use App\Classes\ImageLogic;
use App\Http\Controllers\Controller;
use App\Models\ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function gallery($parent_id, $imageable_type){

        $images = ImageModel::where('imageable_id', $parent_id)->where('imageable_type', $imageable_type)->get();
        return view('admin.components.gallery.images', ['images' => $images]);
    }

    public function storeImage(Request $request, $parent_id){

        request()->validate([
            'picture'  => 'required|mimes:jpeg,bmp,png,jpg',
            'picture_small'  => 'mimes:jpeg,bmp,png,jpg',
            'imageable_type' => 'in:News,Page,Poster,Project,Lesson,Consultation,Device'
        ]);

        $image = new ImageLogic();
        $image -> originalImage = $request->file('picture');
        $image -> path = '/gallery/';

        $image->storeImage();
        $picture_link = $image->pictureLink;

        $image_small = new ImageLogic();
        $image_small -> originalImage = $request->file('picture');
        $image_small -> path = '/small_gallery/';
        $image_small->length = 600;
        $image_small->height = 400;
        $image_small->storeImage();
        $picture_small_link = $image_small->pictureLink;


        $imageable_type = request('imageable_type');
        $imageable_type = "App\\Models\\$imageable_type";

        ImageModel::create([
            'picture' => $picture_link,
            'picture_small' => $picture_small_link,
            'imageable_id' => $parent_id,
            'imageable_type' => $imageable_type,
        ]);

        return redirect()->route('images.gallery', [$parent_id, $imageable_type]);
    }

    public function destroyImage($parent_id){

        request()->validate([
            'id' => ['required','integer']
        ]);

        $image = ImageModel::find(request('id'));

        $imageable_type = $image->imageable_type;
        Storage::delete($image->picture);
        Storage::delete($image->picture_small);
        $image->delete();

        $images = ImageModel::where('imageable_id', $parent_id)->where('imageable_type', $imageable_type)->get();
        return view('admin.components.gallery.images', ['images' => $images]);
    }
}
