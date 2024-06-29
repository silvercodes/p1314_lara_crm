<?php

declare(strict_types=1);

namespace App\Services\File;

use Illuminate\Http\UploadedFile;

abstract class AbstractFileService
{
    abstract function save(UploadedFile $file);
}