<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Classes\ImageLogic;
use Illuminate\Http\RedirectResponse;

class PosterController extends Controller
{

    public function index()
    {
        return view('admin.posters.index', ['posters' => Poster::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|nullable',
        ]);

        $poster = new Poster();
        $poster->link = Str::of($inputs['name'])->slug('-');
        $poster->save();

        $translations = [
            'en' => [
                'name' => $inputs['name'],
            ],
            'ro' => [
                'name' => $inputs['name'],
            ],
            'ru' => [
                'name' => $inputs['name'],
            ],
        ];

        foreach ($translations as $locale => $translation) {
            $poster->translateOrNew($locale)->name = $translation['name'];
        }

        $poster->save();

        return redirect()->route('admin.posters.edit', $poster->id);
    }

    public function changeStatus(Poster $poster)
    {
        $poster->update(['active' => !$poster->active]);
        return redirect()->route('admin.posters');
    }


    public function edit(Poster $poster)
    {
        return view('admin.posters.edit', ['poster' => $poster]);
    }


    public function update(Request $request, Poster $poster)
    {
        $request->validate([
            'en_name' => 'max:255|nullable',
            'en_content' => 'nullable',
            'ro_name' => 'max:255|nullable',
            'ro_content' => 'nullable',
            'ru_name' => 'max:255|nullable',
            'ru_content' => 'nullable',
            'link' => 'max:255|nullable',
        ]);

        // Update the main model field
        $poster->link = $request->input('link');

        // Update English translations
        $poster->translateOrNew('en')->name = $request->input('en_name');
        $poster->translateOrNew('en')->description = $request->input('en_content');

        // Update Romanian translations
        $poster->translateOrNew('ro')->name = $request->input('ro_name');
        $poster->translateOrNew('ro')->description = $request->input('ro_content');

        // Update Russian translations
        $poster->translateOrNew('ru')->name = $request->input('ru_name');
        $poster->translateOrNew('ru')->description = $request->input('ru_content');

        // Save the changes to the database
        $poster->save();
        return redirect()->route('admin.posters');
    }

    public function storeImageGeneral(Request $request, Poster $poster)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $poster->picture);
        $file->storeAs(
            'public/posters',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'posters/' . $filename . '.' . (string) $extenstion;

        $poster->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Poster $poster, Request $request)
    {
        if ($poster->picture) {
            Storage::delete($poster->picture);
        }
        $poster->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $poster->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral(Poster $poster)
    {
        DeleteImage::delete($poster);
        return back();
    }
}
