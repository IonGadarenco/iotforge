<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    protected $guarded = ['id'];
    protected $table = 'images';


    public function imageable()
    {
        return $this->morphTo();
    }
}
