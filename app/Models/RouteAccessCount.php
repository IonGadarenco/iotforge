<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteAccessCount extends Model
{
    use HasFactory;
    protected $fillable = ['route_name','daily_access_count', 'last_access_date' ];
    protected $casts = [
        'last_access_date' => 'date',
    ];
}
