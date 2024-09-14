<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Device extends Model
{
    // use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'device_type',
        'device_identifier',
        'active'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function sensors(){
        return $this->hasMany(Sensor::class);
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
