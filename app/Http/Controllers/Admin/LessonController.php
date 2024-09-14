<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class LessonController extends Controller
{

    public function index()
    {
        return view('admin.lessons.index', ['lessons' => Lesson::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
        ]);

        $lesson = new Lesson();

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
            $lesson->translateOrNew($locale)->name = $translation['name'];
        }

        $lesson->save();

        return redirect()->route('admin.lessons.edit', $lesson->id);
    }

    public function changeStatus(Lesson $lesson)
    {
        $lesson->update(['active' => !$lesson->active]);
        return redirect()->route('admin.lessons');
    }


    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', ['lesson' => $lesson]);
    }


    public function update(Request $request, Lesson $lesson)
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
            'trainer' => 'max:255',
            'made_by' => 'max:255',
            'language' => 'max:255',
            'duration' => 'max:255',

        ]);
        $lesson->translate('ro')->update([
            'name' => $request->input('ro_name'),
            'content' => $request->input('ro_content'),
        ]);

        $lesson->translate('en')->update([
            'name' => $request->input('en_name'),
            'content' => $request->input('en_content'),
        ]);

        $lesson->translate('ru')->update([
            'name' => $request->input('ru_name'),
            'content' => $request->input('ru_content'),
        ]);
        $lesson->link = $request->input('link');
        $lesson->duration = $request->input('duration');
        $lesson->language = $request->input('language');
        $lesson->trainer = $request->input(key: 'trainer');
        $lesson->made_by = $request->input(key: 'made_by');
        $lesson->save();  // Save non-translatable fields

        return redirect()->route('admin.lessons');
    }
    public function storeImageGeneral(Request $request, Lesson $lesson)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $lesson->picture);
        $file->storeAs(
            'public/lessons',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'lessons/' . $filename . '.' . (string) $extenstion;

        $lesson->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Lesson $lesson, Request $request)
    {
        if ($lesson->picture) {
            Storage::delete($lesson->picture);
        }
        $lesson->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $lesson->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral(Lesson $lesson)
    {
        DeleteImage::delete($lesson);
        return back();
    }
}


