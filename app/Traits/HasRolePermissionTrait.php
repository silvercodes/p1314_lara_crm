<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolePermissionTrait
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permissions_users');
    }

    public function hasRoles(...$roles): bool
    {
        foreach ($roles as $role)
            if ($this->roles->contains('slug', $role))
                return true;

        return false;
    }

    protected function getPermissionsBySlugs(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    protected function hasPermission(Permission $permission): bool
    {
        return $this->permissions->contains('slug', $permission->slug);
    }

    protected function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role)
            if ($this->roles->contains($role))
                return true;

        return false;
    }

    public function hasPermissionComplete(Permission $permission): bool
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

}