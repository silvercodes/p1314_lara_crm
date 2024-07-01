<?php

declare(strict_types=1);

namespace App\Services\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;

abstract class AbstractFileService
{
    abstract function save(UploadedFile $file);
    abstract function delete(File $file);
}