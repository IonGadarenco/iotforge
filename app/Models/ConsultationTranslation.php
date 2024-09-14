<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationTranslation extends Model
{
    protected $fillable = ['name', 'content'];
    public $timestamps = false;
}
