<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    const DEFAULT_URL = '';
    protected $fillable = [
        'mime_type', 'original_name', 'original_extension', 'path'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function url(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (Storage::exists($this->path))
                    return asset('/storage/' . $this->path);

                return self::DEFAULT_URL;
            }
        );
    }
}
