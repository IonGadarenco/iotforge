<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Poster extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    public $translatedAttributes = ['name', 'description'];

    public function getPictureUrlAttribute()
    {
        $picturePath = $this->picture;

        if (!empty($picturePath)) {
            if (Storage::disk('public')->exists($picturePath)) {
                return asset('storage/' . $picturePath);
            }
        }
        return asset('admin_assets/images/no_image.jpg');
    }
    public function getNameAttribute()
    {
        return $this->translate(app()->getLocale())['name'];
    }
    public function getDescriptionAttribute()
    {
        return $this->translate(app()->getLocale())['description'];
    }

}
