<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ConsultationController extends Controller
{

    public function index()
    {
        return view('admin.consultations.index', ['consultations' => Consultation::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
        ]);

        $consultation = new Consultation();

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
            $consultation->translateOrNew($locale)->name = $translation['name'];
        }

        $consultation->save();

        return redirect()->route('admin.consultations.edit', $consultation->id);
    }

    public function changeStatus(Consultation $consultation)
    {
        $consultation->update(['active' => !$consultation->active]);
        return redirect()->route('admin.consultations');
    }


    public function edit(Consultation $consultation)
    {
        return view('admin.consultations.edit', ['consultation' => $consultation]);
    }


    public function update(Request $request, Consultation $consultation)
    {
       // dd($request->all());

        $request->validate([
            'en_name' => 'max:255',
            'ro_name' => 'max:255',
            'ru_name' => 'max:255',
            'ro_content' => 'string|nullable',
            'ru_content' => 'string|nullable',
            'en_content' => 'string|nullable',
            'link' => 'max:255',
            'consultant' => 'max:255',


        ]);
        $consultation->translate('ro')->update([
            'name' => $request->input('ro_name'),
            'content' => $request->input('ro_content'),
        ]);

        $consultation->translate('en')->update([
            'name' => $request->input('en_name'),
            'content' => $request->input('en_content'),
        ]);

        $consultation->translate('ru')->update([
            'name' => $request->input('ru_name'),
            'content' => $request->input('ru_content'),
        ]);
        $consultation->link = $request->input('link');
        $consultation->consultant = $request->input('consultant');
        $consultation->save();  // Save non-translatable fields

        return redirect()->route('admin.consultations');
    }
    public function storeImageGeneral(Request $request, Consultation $consultation)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $consultation->picture);
        $file->storeAs(
            'public/consultations',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'consultations/' . $filename . '.' . (string) $extenstion;

        $consultation->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Consultation $consultation, Request $request)
    {
        if ($consultation->picture) {
            Storage::delete($consultation->picture);
        }
        $consultation->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $consultation->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral(Consultation $consultation)
    {
        DeleteImage::delete($consultation);
        return back();
    }
}


