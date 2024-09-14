<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTranslation extends Model
{

    protected $fillable = ['name','content'];
    public $timestamps = false;
}
