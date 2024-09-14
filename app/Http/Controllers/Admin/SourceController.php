<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Classes\ImageLogic;
use Illuminate\Http\RedirectResponse;

class SourceController extends Controller
{

    public function index()
    {
        return view('admin.sources.index', ['sources' => Source::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|nullable',
        ]);

        $source = new Source();
        $source->link = Str::of($inputs['name'])->slug('-');
        $source->save();

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
            $source->translateOrNew($locale)->name = $translation['name'];
        }

        $source->save();

        return redirect()->route('admin.sources.edit', $source->id);
    }

    public function changeStatus(Source $source)
    {
        $source->update(['active' => !$source->active]);
        return redirect()->route('admin.sources');
    }


    public function edit(Source $source)
    {
        return view('admin.sources.edit', ['source' => $source]);
    }


    public function update(Request $request, Source $source)
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
        $source->link = $request->input('link');

        // Update English translations
        $source->translateOrNew('en')->name = $request->input('en_name');
        $source->translateOrNew('en')->content = $request->input('en_content');

        // Update Romanian translations
        $source->translateOrNew('ro')->name = $request->input('ro_name');
        $source->translateOrNew('ro')->content = $request->input('ro_content');

        // Update Russian translations
        $source->translateOrNew('ru')->name = $request->input('ru_name');
        $source->translateOrNew('ru')->content = $request->input('ru_content');

        // Save the changes to the database
        $source->save();
        return redirect()->route('admin.sources');
    }

    public function storeImageGeneral(Request $request, Source $source)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $source->picture);
        $file->storeAs(
            'public/sources',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'sources/' . $filename . '.' . (string) $extenstion;

        $source->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Source $source, Request $request)
    {
        if ($source->picture) {
            Storage::delete($source->picture);
        }
        $source->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $source->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral(Source $source)
    {
        DeleteImage::delete($source);
        return back();
    }
}
