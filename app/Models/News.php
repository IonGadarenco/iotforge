<?php

namespace App\Models;

use App\Classes\ImageLogic;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class News extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    protected $fillable = ['data', 'picture', 'picture_small', 'parent', 'projects_id', 'active'];

    public $translatedAttributes = ['name', 'content'];


    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\ImageModel', 'imageable');
    }
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'parent');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function storeImageGeneral($uploadedPicture)
    {
        if ($this->picture) {
            Storage::delete($this->picture);
        }
        if ($this->picture_small) {
            Storage::delete($this->picture_small);
        }

        $image = new ImageLogic();
        $image->originalImage = $uploadedPicture;
        $image->path = '/news';
        $image->length = 770;
        $image->height = 472;
        $image->storeImage();
        $inputs['picture'] = $image->pictureLink;

        $image_small = new ImageLogic();
        $image_small->originalImage = $uploadedPicture;
        $image_small->path = '/small_news';
        $image_small->length = 97;
        $image_small->height = 97;
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
                return asset('storage' . $picturePath);
            }
        }
        return asset('admin_assets/images/no_image.jpg');
    }
    public function getSmallPictureUrlAttribute()
    {
        $picturePath = $this->picture_small;

        if (!empty($picturePath)) {
            if (Storage::disk('public')->exists($picturePath)) {
                return asset('storage/' . $picturePath);
            }
        }
        return asset('assets/images/gallery/gallery-bg-1.png');
    }

    public function getNameAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        return $translation ? $translation['name'] : null;
    }

    public function getContentAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        return $translation ? $translation['content'] : null;
    }

}
