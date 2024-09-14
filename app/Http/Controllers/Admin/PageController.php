<?php

namespace App\Http\Controllers\Admin;

use App\Classes\DeleteImage;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::where('parent', NULL)->orderBy('ord')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function store()
    {
        $inputs = request()->validate([
            'name' => 'max:255|string|required',
        ]);

        $page = new Page();
        $page->link_name = Str::of($inputs['name'])->slug('-');
        $page->save();

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
            $page->translateOrNew($locale)->name = $translation['name'];
        }

        $page->save();

        return redirect()->route('admin.pages.edit', $page->id)->with('success-message', 'Pagina o fost creata cu succes.');
    }
    public function edit(Page $page)
    {

        return view('admin.pages.edit', ['page' => $page]); //
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'en_name' => 'nullable|max:255',
            'en_content' => 'nullable|string',
            'ro_name' => 'nullable|max:255',
            'ro_content' => 'nullable|string',
            'ru_name' => 'nullable|max:255',
            'ru_content' => 'nullable|string',
            'link_name' => 'nullable|max:255',
        ]);

        // Update the main model field
        $page->link_name = $request->input('link_name');

        // Update English translations
        $page->translateOrNew('en')->name = $request->input('en_name');
        $page->translateOrNew('en')->content = $request->input('en_content');

        // Update Romanian translations
        $page->translateOrNew('ro')->name = $request->input('ro_name');
        $page->translateOrNew('ro')->content = $request->input('ro_content');

        // Update Russian translations
        $page->translateOrNew('ru')->name = $request->input('ru_name');
        $page->translateOrNew('ru')->content = $request->input('ru_content');

        // Save the main model and its translations
        $page->save();

        return redirect()->route('admin.pages')->with('success-message', 'Pagina s-a actualizat cu succes.');
    }


    public function destroy(Page $page)
    {
        if ($page->picture) {
            Storage::delete($page->picture);
        }
        $page->delete();

        session()->flash('deleted', 'Pagina cu id-ul: ' . $page->id . ' a fost șters');
        return redirect()->route('admin.pages');
    }


    public function setFirstMenu(Page $page, $feat)
    {
        $feat = (int) $feat;
        $page->update(['first_menu' => $feat]);
        return redirect()->route('admin.pages');
    }

    public function setSecondMenu(Page $page, $feat)
    {
        $feat = (int) $feat;
        $page->update(['second_menu' => $feat]);
        return redirect()->route('admin.pages');
    }

    /**
     * AjaxRequest. Order pages and set parents.
     * Recursive Method
     * @param int $parent
     * @param array $childrens
     */
    public function orderPages($parent = NULL, $childrens = array())
    {
        if (!empty($childrens)) {
            $pages_arr = $childrens;
        } else {
            $pages_arr = json_decode(request()->JSON);

        }
        $order = 0;
        for ($i = 0; $i < count($pages_arr); $i++) {
            $order++;
            $page_id = $pages_arr[$i]->id;
            $page = Page::where('id', $page_id)->first();
            $page->update(['ord' => $order, 'parent' => $parent]);
            if (isset($pages_arr[$i]->children)) {
                $this->orderPages($page_id, $pages_arr[$i]->children);
            }
        }
    }

    public function storeImageGeneral(Request $request, Page $page)
    {
        request()->validate([
            'picture' => 'required|mimes:jpeg,bmp,png,jpg,webp',
        ]);
        $file = $request->file('picture');
        $extenstion = $file->extension();
        $filename = time();
        Storage::delete('public/' . $page->picture);
        $file->storeAs(
            'public/pages',
            $filename . '.' . (string) $extenstion
        );
        $inputs['picture'] = 'pages/' . $filename . '.' . (string) $extenstion;

        $page->update($inputs);

        echo asset('storage/' . $inputs['picture']);
    }
    public function deleteImageGeneral(Page $page)
    {
        DeleteImage::delete($page);

        return back();
    }
}
