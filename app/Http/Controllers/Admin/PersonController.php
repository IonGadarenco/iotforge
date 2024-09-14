<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PersonController extends Controller
{

    public function index()
    {
        return view('admin.persons.index', ['persons' => Person::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
            'position' => 'max:255|string|required',
        ]);

        $person = new Person();

        $translations = [
            'en' => [
                'name' => $inputs['name'],
                'position' => $inputs['position'],
            ],
            'ro' => [
                'name' => $inputs['name'],
                'position' => $inputs['position'],
            ],
            'ru' => [
                'name' => $inputs['name'],
                'position' => $inputs['position'],
            ],
        ];

        foreach ($translations as $locale => $translation) {
            $person->translateOrNew($locale)->name = $translation['name'];
            $person->translateOrNew($locale)->position = $translation['position'];
        }

        $person->save();

        return redirect()->route('admin.persons.edit', $person->id);
    }

    public function changeStatus(Person $person)
    {
        $person->update(['active' => !$person->active]);

        return redirect()->route('admin.persons');
    }


    public function edit(Person $person)
    {
        return view('admin.persons.edit', ['person' => $person]);
    }


    public function update(Request $request, Person $person)
    {
            $request->validate([
            'en_name' => 'max:255',
            'en_position' => 'nullable|max:255',
            'en_content' => 'nullable',
            'en_description' => 'nullable|max:255',
            'ro_name' => 'max:255',
            'ro_position' => 'nullable|max:255',
            'ro_content' => 'nullable',
            'ro_description' => 'nullable|max:255',
            'ru_name' => 'max:255',
            'ru_position' => 'nullable|max:255',
            'ru_content' => 'nullable',
            'ru_description' => 'nullable|max:255',
        ]);
        $languages = ['en', 'ro', 'ru'];

        foreach ($languages as $lang) {
            $person->translateOrNew($lang)->update([
                'name' => $request->input("{$lang}_name"),
                'position' => $request->input("{$lang}_position"),
                'content' => $request->input("{$lang}_content"),
                'description' => $request->input("{$lang}_description"),
            ]);
        }

        return redirect()->route('admin.persons');
    }

    public function storeImageGeneral(Request $request, Person $person)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $person->picture);
        $file->storeAs(
            'public/persons',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'persons/' . $filename . '.' . (string) $extenstion;

        $person->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Person $person, Request $request)
    {
        if ($person->picture) {
            Storage::delete($person->picture);
        }
        $person->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $person->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral( Person $person)
    {
        DeleteImage::delete($person);
        return back();
    }
}

