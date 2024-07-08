<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'id', 'title', 'slug'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permissions_roles');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'permissions_users');
    }
}
