<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{

    protected $fillable = ['name', 'content', 'scope','funder'];
    public $timestamps = false;
}
