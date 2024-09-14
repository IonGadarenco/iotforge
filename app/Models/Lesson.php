<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Lesson extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    protected $fillable = ['link', 'picture', 'active', 'duration', 'trainer', 'language', 'made_by'];
    public $translatedAttributes = ['name', 'content'];


    public function getNameAttribute()
    {
        return $this->translate(app()->getLocale())['name'];
    }
    public function getContentAttribute()
    {
        return $this->translate(app()->getLocale())['content'];
    }
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
}
