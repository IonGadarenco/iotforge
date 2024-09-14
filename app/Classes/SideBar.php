<?php

namespace App\Classes;

use App\Models\News;

class SideBar
{
    public static function latestNews()
    {
        $news = News::where('active', 1)
            ->orderBy('data', 'desc')
            ->limit(4)->get();
        value:
        return $news;
    }
}
