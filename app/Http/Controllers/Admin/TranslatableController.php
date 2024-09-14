<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\TranslationLoader\LanguageLine;

class TranslatableController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->all();
        $query_lang = LanguageLine::orderBy('group', 'ASC');
        if ($request->input('groups_search')) {
            $query_lang->where('group', 'LIKE', $request->input('groups_search'));
        }
        if ($request->input('value_search')) {
            $value = $request->input('value_search');
            $query_lang->where('text', 'LIKE', "%$value%")->orWhere('key', 'LIKE', "%$value%");
        }
        $languages = $query_lang->paginate(35);

        $groups = LanguageLine::select('group')->distinct('group')->orderBy('group', 'ASC')->get();
        return view('admin.translatable.translate', compact('languages', 'groups', 'data'));
    }

    public function create()
    {
        return view('admin.translatable.insert');
    }

    public function edit(Request $request)
    {
        $edit = LanguageLine::where('id', $request->id)->first();
        return view('admin.translatable.edit', ['edit' => $edit]);
    }

    public function delete(Request $request)
    {
        $translate = LanguageLine::find($request->id);
        if ($translate) {
            $translate->delete();
        } else {
            return back()->withErrors(['Something goes wrong!']);
        }

        Session::flash('success', 'You have successfully deleted item.');

        return redirect()->route('admin.translate');
    }

    public function update(Request $request)
    {
        $request->validate([
            'group' => 'required|max:255',
            'key' => 'required|max:255',
            'en' => 'required',
            'ro' => 'required',
            'ru' => 'required',
        ]);

        $translate = LanguageLine::findOrFail($request->id);
        $translate->group = $request->input('group');
        $translate->key = $request->input('key');
        $translate->text = [
            'en' => $request->input('en'),
            'ro' => $request->input('ro'),
            'ru' => $request->input('ru')
        ];
        $translate->save();
        Session::flash('success', 'You have successfully uppdate item.');

        return redirect()->route('admin.translate');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'group' => 'required|max:255',
            'key' => 'required|max:255',
            'en' => 'required',
            'ro' => 'required',
            'ru' => 'required',
        ]);
        LanguageLine::create([
            'group' => $request->input('group'),
            'key' => $request->input('key'),
            'text' => ['en' => $request->input('en'), 'ro' => $request->input('ro'), 'ru' => $request->input('ru')],
        ]);
        Session::flash('success', 'You have successfully added item.');

        return redirect()->route('admin.translate');
    }

    public function setLanguage($language)
    {
        Session::put('locale', $language);
        session_start();
        switch ($language) {
            case 'ro':
                $intLanguage = 1;
                break;
            case 'ru':
                $intLanguage = 2;
                break;
            default:
                $intLanguage = 0;
        }
        $_SESSION['current_language'] = $intLanguage;
        return redirect()->back();
    }
}
