<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', ['reports' => Report::all()]);
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
        ]);

        $report = new Report();
        $report->save();

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
            $report->translateOrNew($locale)->name = $translation['name'];
        }

        $report->save();

        return redirect()->route('admin.reports.edit', $report->id);
    }

    public function changeStatus(Report $report)
    {
        $report->update(['active' => !$report->active]);
        return redirect()->route('admin.reports');
    }


    public function edit(Report $report)
    {
        return view('admin.reports.edit', ['report' => $report]);
    }


    public function update(Request $request, Report $report)
    {
        // dd($request->all());
        $request->validate([
            'en_name' => 'max:255',
            'en_content' => 'nullable',
            'ro_name' => 'max:255',
            'ro_content' => 'nullable',
            'ru_name' => 'max:255',
            'ru_content' => 'nullable',
            'link' => 'nullable|string',
            'embed' => 'nullable|string',
            'file' => ['nullable', 'file', 'mimes:jpg,png,pdf,pptx,ppt', 'max:6048'],
        ]);

        foreach (['en', 'ro', 'ru'] as $locale) {
            $report->translateOrNew($locale)->update([
                'name' => $request->input("{$locale}_name"),
                'content' => $request->input("{$locale}_content")
            ]);
        }

        $report->link = $request->input('link');
        $report->embed = $request->input('embed');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('reports', $fileName, 'public');
            $report->file = $filePath;
        }

        $report->save();
        return redirect()->route('admin.reports');
    }
    public function storeImageGeneral(Request $request, Report $report)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $report->picture);
        $file->storeAs(
            'public/reports',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'reports/' . $filename . '.' . (string) $extenstion;

        $report->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }


    public function destroy(Report $report, Request $request)
    {
        if ($report->picture) {
            Storage::delete($report->picture);
        }
        $report->delete();
        $request->session()->flash('deleted', 'Baner-ul cu id-ul: ' . $report->id . ' a fost șters');
        return back(); //
    }
    public function deleteImageGeneral(Report $report)
    {
        DeleteImage::delete($report);
        return back();
    }
}

