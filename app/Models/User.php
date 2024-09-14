<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'active', 'password', 'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }
    public function assignRoleFullAccess()
    {
        // Retrieve roles that have a relationship with all available permissions
        $fullAccessRole = Role::whereDoesntHave('permissions', function ($query) {
            // Check for permissions that are not associated with this role
            $query->whereNotIn('permissions.id', Permission::pluck('id'));
        })->where('guard_name', 'admin')->first();

        // Attach the roles to the user
        $this->roles()->attach($fullAccessRole);
    }
    public function hasRole($roleId)
    {
        return $this->roles()->where('role_id', $roleId)->exists();
    }
    public function hasFullAcces($userId)
    {
        $full_access = Role::whereDoesntHave('permissions', function ($query) {
            // Check for permissions that are not associated with this role
            $query->whereNotIn('permissions.id', Permission::pluck('id'));
        })->where('guard_name', 'admin')->first();

        return $this->roles()->where('user_id', $userId)->where('role_id', $full_access->id)->exists();
    }

    public function UserHasPermission($permissionId)
    {
        if (!$this->allPermissions) {
            $this->loadAllPermissions();
        }

        if (in_array($permissionId, $this->allPermissions)) {
            return true;
        }

        return $this->roles()->whereHas('permissions', function ($permissionQuery) use ($permissionId) {
            $permissionQuery->where('permissions.id', $permissionId);
        })->exists();
    }

    protected function loadAllPermissions()
    {
        $allPermissions = [];
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                $allPermissions[] = $permission->id;
            }
        }
        $this->allPermissions = $allPermissions;
    }
    public function scopeWithPermission($query, $permissionId)
    {
        return $query->whereHas('roles', function ($roleQuery) use ($permissionId) {
            $roleQuery->whereHas('permissions', function ($permissionQuery) use ($permissionId) {
                $permissionQuery->where('permissions.id', $permissionId);
            });
        });
    }
    public function deleteImageGeneral($request)
    {
        try {
            if ($this->picture) {
                Log::info('Attempting to delete image: ' . $this->picture);

                $disk = 'public'; // Adjust according to your setup
                $filePath = str_replace('/storage', '', $this->picture); // Adjust path if necessary

                if (Storage::disk($disk)->exists($filePath)) {
                    Storage::disk($disk)->delete($filePath);
                    Log::info('Image deleted successfully from storage: ' . $filePath);
                } else {
                    Log::warning('File does not exist in storage: ' . $filePath);
                    $request->session()->flash('error', 'File does not exist in storage');
                }
            }

            $this->picture = '';
            $this->update();
            Log::info('Database updated, picture attribute cleared for poster ID: ' . $this->id);

            $request->session()->flash('success', 'Imaginea de bază a fost ștersă');
        } catch (\Exception $e) {
            Log::error('Error deleting image from storage: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            $request->session()->flash('error', 'An error occurred while deleting the image.');
        }
    }
}
