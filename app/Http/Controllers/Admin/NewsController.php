<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $queryNews = News::query();

        if ($request->input('title')) {
            $title = $request->input('title');
            $queryNews->whereHas('translations', function ($q) use ($title) {
                $q->where('name', 'LIKE', "%$title%");
                return $q;
            });
        }
        if ($request->input('type')) {
            $queryNews->where('type', '=', $request->input('type'));
        }

        $news = $queryNews
            ->orderByDesc('data')
            ->paginate(25);

        return view(
            'admin.news.index',
            compact('data', 'news')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): RedirectResponse
    {
        $inputs = request()->validate([
            //            'type' => 'required|max:20',
            'name' => 'string|max:255',
        ]);
        $news = new News();
        $news->translateOrNew('en')->name = $inputs['name'];
        $news->translateOrNew('ro')->name = $inputs['name'];
        $news->translateOrNew('ru')->name = $inputs['name'];
        $news->save();

        return redirect()->route('admin.news.edit', $news->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news_single = News::findOrFail($news->id);
        return view(
            'admin.news.edit',
            compact('news_single')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        // dd($request->all());
        $request->validate([
            'ro_name' => 'required|string',
            'ru_name' => 'string|nullable',
            'en_name' => 'string|nullable',
            'ro_content' => 'max:255|nullable',
            'ru_content' => 'string|nullable',
            'en_content' => 'string|nullable',
        ]);


        // Update English translations
        $news->translateOrNew('en')->name = $request->input('en_name');
        $news->translateOrNew('en')->content = $request->input('en_content');

        // Update Romanian translations
        $news->translateOrNew('ro')->name = $request->input('ro_name');
        $news->translateOrNew('ro')->content = $request->input('ro_content');

        // Update Russian translations
        $news->translateOrNew('ru')->name = $request->input('ru_name');
        $news->translateOrNew('ru')->content = $request->input('ru_content');


        $news->update([
            'data' => $request->input('data') ?: null,
            'parent' => $request->input(key: 'parent') ?: null,
            'project_id' => $request->input(key: 'project_id') ?: null,
            'active' => 1
        ]);
        // dd($news);

        return redirect()->route('admin.news');
    }

    public function changeStatus(News $news)
    {
        $news->update(['active' => !$news->active]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news, Request $request)
    {
        DeleteImage::delete($news);

        $news->delete();
        $request->session()->flash('deleted', 'Noutatea cu id-ul: ' . $news->id . ' a fost ștearsă.');

        return back();
    }

    public function storeImageGeneral(Request $request, News $news)
    {

        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp',
        ]);

        $pictureLink = $news->storeImageGeneral($request->file('picture'));

        echo asset('storage/' . $pictureLink);
    }

    public function deleteImageGeneral(News $news)
    {
        DeleteImage::delete($news);
        return back();
    }
}
