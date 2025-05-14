<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public static function getPermissionGroupName($permission_group_id)
    {
        $permission_group = PermissionGroup::find($permission_group_id);

        return $permission_group->name;
    }
}
