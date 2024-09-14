<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Project extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id'];
    protected $fillable = ['start_date', 'end_date', 'budget', 'active', 'picture', 'picture_small'];
    public $translatedAttributes = ['name', 'content', 'scope', 'funder'];

    public static function getProjectsForNews()
    {
        return Project::select('id')->get();
    }
    public function news()
    {
        return $this->hasMany(News::class, 'project_id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\ImageModel', 'imageable');
    }
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function scopeCurrent($query)
    {
        // Replace the following condition with your actual criteria for "current" projects
        return $query->where('active', 1)->whereDate('end_date', '>=', today());

    }
    public function scopeFinished($query)
    {
        return $query->where('active', 1)->whereDate('end_date', '<', today());
    }

    public function getNameAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        if (!$translation) {
            $translation = $this->translate(config('app.fallback_locale'));
        }
        return $translation ? $translation['name'] : $this->attributes['name'];
    }

    public function getContentAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        if (!$translation) {
            $translation = $this->translate(config('app.fallback_locale'));
        }
        return $translation ? $translation['content'] : $this->attributes['content'];
    }
    public function getScopeAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        if (!$translation) {
            $translation = $this->translate(config('app.fallback_locale'));
        }
        return $translation ? $translation['scope'] : $this->attributes['scope'];
    }
    public function getFunderAttribute()
    {
        $translation = $this->translate(app()->getLocale());
        if (!$translation) {
            $translation = $this->translate(config('app.fallback_locale'));
        }
        return $translation ? $translation['funder'] : $this->attributes['funder'];
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
    public function getProgressAttribute()
    {
        $start_date = Carbon::parse($this->start_date);
        $end_date = Carbon::parse($this->end_date);
        $today = Carbon::now();
        $totalDays = $start_date->diffInDays($end_date);

        $daysPassed = $start_date->diffInDays($today);

        if ($today->lt($start_date)) {
            $daysPassed = 0;
        } elseif ($today->gt($end_date)) {
            $daysPassed = $totalDays;
        }
        $percentagePassed = round(($daysPassed / $totalDays) * 100);
        return $percentagePassed;
    }
}
