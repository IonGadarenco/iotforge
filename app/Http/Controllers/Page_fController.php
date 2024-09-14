<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\News;
use App\Models\Page;
use App\Models\Product;

class Page_fController extends Controller
{
    public function page($linkName)
    {
        $page = Page::query()
            ->where('link_name', $linkName)
            ->where(function ($query) {
                $query->where('first_menu', 1)
                    ->orWhere('second_menu', 1);
            })
            ->first();

        if ($page) {
            return view(
                'frontend.pages.page_universal',
                compact('page', 'latest_projects')
            );
        } else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('frontend.pages.errorPage', $data, 404);
        }
    }
}
