<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Locale extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'locale';
    protected $guarded = ['id'];

}
