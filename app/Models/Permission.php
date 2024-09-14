<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use Notifiable, HasFactory;
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    protected $guarded = ['id'];

    const PAGES = 1;
    const CONFIG = 2;
    const ACTIVITIES = 3;
    const LOGS = 5;
    const ADMINS = 6;
    const ROLES = 7;
    const CONSTANTS = 8;
    const PRODUCTS = 9;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
