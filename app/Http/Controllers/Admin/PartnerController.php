<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PartnerController extends Controller
{

    public function index()
    {
        return view('admin.partners.index', ['partners' => Partner::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
        ]);

        $partner = new Partner();

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
            $partner->translateOrNew($locale)->name = $translation['name'];
        }

        $partner->save();

        return redirect()->route('admin.partners.edit', $partner->id);
    }

    public function changeStatus(Partner $partner)
    {
        $partner->update(['active' => !$partner->active]);
        return redirect()->route('admin.partners');
    }


    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', ['partner' => $partner]);
    }


    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'en_name' => 'max:255',
            'ro_name' => 'max:255',
            'ru_name' => 'max:255',
            'link' => 'max:255',


        ]);
        $poster_data = [
            'en' => [
                'name' => $request->input('en_name')
            ],
            'ro' => [
                'name' => $request->input('ro_name')
            ],
            'ru' => [
                'name' => $request->input('ru_name')
            ],
            'link' => Str::of($request->input('link'))->slug('-'),
        ];


        $partner->update($poster_data);
        return redirect()->route('admin.partners');
    }
    public function storeImageGeneral(Request $request, Partner $partner)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $partner->picture);
        $file->storeAs(
            'public/partners',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'partners/' . $filename . '.' . (string) $extenstion;

        $partner->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Partner $partner, Request $request)
    {
        if ($partner->picture) {
            Storage::delete($partner->picture);
        }
        $partner->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $partner->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral( Partner $partner)
    {
        DeleteImage::delete($partner);
        return back();
    }
}

