<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function files($parent_id, $fileable_type){
        $files = File::where('fileable_id', $parent_id)->where('fileable_type', $fileable_type)->get();
        return view('admin.components.files.files', ['files' => $files]);
    }


    public function storeFile(Request $request, $parent_id){
        request()->validate([
            'name' => ['string', 'max:255'],
            'category_id' => ['nullable'],
            'file'  => 'required|mimes:txt,pdf,xlx,png,jpg,docx,doc,ppt,pptx',
            'fileable_type' => 'in:Page,News,Project,Report'
        ]);

        $file_link = $request->file('file')->store('public/files');

        $fileable_type = request('fileable_type');
        $fileable_type = "App\\Models\\$fileable_type";
        $file_link = str_replace('public', '', $file_link);


        File::create(
            [

                'file' => $file_link,
                'fileable_id' => $parent_id,
                'fileable_type' => $fileable_type,
                'name' =>request('name'),
            ]
        );

        return redirect()->route('files.main', [$parent_id, $fileable_type]);
    }

    public function updateFile(File  $file){

        $inputs = request()->validate([
            'name' => ['nullable', 'string'],
        ]);

        $file->update($inputs);

        return redirect()->back();
    }


    public function destroyFile($parent_id){
        request()->validate([
            'id' => ['required','integer']
        ]);

        $file = File::find(request('id'));

        $fileable_type = $file->fileable_type;
        Storage::delete($file->file);
        $file->delete();

        $file = File::where('fileable_id', $parent_id)->where('fileable_type', $fileable_type)->get();
        return view('admin.components.files.files', ['files' => $file]);
    }


}
