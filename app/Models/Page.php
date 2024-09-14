<?php

namespace App\Models;

use App\Classes\ImageLogic;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Page extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id'];
    public $translatedAttributes = ['name', 'content'];

    public function SubPages()
    {
        return $this->hasMany(Page::class, 'parent')
            ->orderBy('ord', 'ASC');
    }
    public function SubPagesFront()
    {
        return $this->hasMany(Page::class, 'parent')
            ->where('first_menu', 1)
            ->orderBy('ord', 'ASC');
    }

    public function Parent()
    {
        return $this->belongsTo(Page::class, 'parent');
    }

    public function images()
    {
        return $this->morphMany('App\Models\ImageModel', 'imageable');
    }

    public static function getParentsForNews()
    {
        return Page::all();
    }

    public function news()
    {
        return $this->hasMany(News::class, 'parent');
    }

    public function activeNews()
    {
        return $this->news()->where('active', '=', 1)->orderBy('data', 'DESC')->paginate(18);
    }
    public function lastNews()
    {
        return $this->news()->where('active', '=', 1)->orderBy('data', 'DESC')->take(4)->get();
    }
    public function files()
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

    public function storeImageGeneral($uploadedPicture)
    {

        Storage::delete($this->picture);
        Storage::delete($this->picture_small);

        $image = new ImageLogic();
        $image->originalImage = $uploadedPicture;
        $image->path = '/pages/';
        $image->length = 770;
        $image->height = 364;
        $image->storeImage();
        $inputs['picture'] = $image->pictureLink;

        $image_small = new ImageLogic();
        $image_small->originalImage = $uploadedPicture;
        $image_small->path = '/small_pages/';
        $image_small->length = 363;
        $image_small->height = 217;
        $image_small->storeImage();
        $inputs['picture_small'] = $image_small->pictureLink;

        $this->update($inputs);

        return $image->pictureLink;
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
    public static function setNameToPage($newPageName)
    {
        $page = new self();

        // Set translations
        $page->translateOrNew('en')->name = $newPageName;
        $page->translateOrNew('ro')->name = $newPageName;
        $page->translateOrNew('ru')->name = $newPageName;

        return $page;
    }

}
