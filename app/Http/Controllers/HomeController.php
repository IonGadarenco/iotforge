<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Poster;
use App\Models\Project;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function main()
    {
        $posters = Poster::where('active', 1)->get();

        $news = News::where('active', 1)
            ->orderBy('data', 'desc')
            ->limit(6)
            ->get();

        $projects = Project::current()->limit(4)->get();

        return view('frontend.home', compact('posters', 'news', 'projects'));
    }

    public function language(string $language)
    {
        if (!in_array($language, ['en', 'ro', 'ru'])) {
            return redirect()->view('frontend.pages.errorPage');
        }
        Session::put('locale', $language);
        request()->session()->put('locale', $language);

        return redirect()->back();
    }

}
