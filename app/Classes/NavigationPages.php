<?php

namespace App\Classes;

use App\Models\Page;

class NavigationPages
{
    public static function getSubPages()
    {
        $query = Page::query();


        return $query->where('parent', NULL)
            ->where('first_menu', 1)
            ->orderBy('ord')
            ->get();
    }

    public static function getFooterPages()
    {
        $query = Page::query();
        return $query->where('second_menu', 1)
            ->orderBy('ord')
            ->get();
    }
}
