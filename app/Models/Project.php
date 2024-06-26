<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'type', 'description', 'contacts'
    ];

    protected $hidden = [
        'avatar_file_id',
        'ts_file_id',
        'created_at',
        'updated_at',
    ];

    public function avatarFile()
    {
        return $this->hasOne(File::class, 'avatar_file_id');
    }

    public function tsFile()
    {
        return $this->hasOne(File::class, 'ts_file_id');
    }


}
