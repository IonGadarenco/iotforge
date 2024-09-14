<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Report extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    protected $fillable = ['link', 'file','active','embed'];
    public $translatedAttributes = ['name', 'content'];

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }
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
