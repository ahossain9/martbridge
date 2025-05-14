<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function roleHasPermissions($role, $permissions): bool
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (! $role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                break;
            }
        }

        return $hasPermission;
    }

    public static function getUserPermissionsGroups(): Collection
    {
        return DB::table('permissions')
            ->select('group_name as name')
            ->where('guard_name', 'admin')
            ->groupby('group_name')
            ->get();
    }

    public static function getUserPermissionsByGroupName($group_name): Collection
    {
        return DB::table('permissions')
            ->select('name', 'id')
            ->where('guard_name', 'admin')
            ->where('group_name', $group_name)
            ->get();
    }
}
