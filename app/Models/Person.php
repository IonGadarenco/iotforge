<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Person extends Model implements TranslatableContract

{
    use Translatable;
    protected $table ='persons';
    protected $guarded = ['id'];
    protected $fillable = ['active'];

    public $translatedAttributes = ['name', 'content', 'description', 'position', 'facebook', 'email'];


    public function getNameAttribute()
    {
        return $this->translate(app()->getLocale())['name'];
    }
    public function getContentAttribute()
    {
        return $this->translate(app()->getLocale())['content'];
    }
    public function getDescriptionAttribute()
    {
        return $this->translate(app()->getLocale())['description'];
    }
    public function getPositionAttribute()
    {
        return $this->translate(app()->getLocale())['position'];
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
