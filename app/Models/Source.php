<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Source extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    protected $fillable = ['active', 'link'];

    public $translatedAttributes = ['name', 'content'];


    public function getNameAttribute()
    {
        return $this->translate(app()->getLocale())['name'];
    }
    public function getContentAttribute()
    {
        return $this->translate(app()->getLocale())['content'];
    }

}
