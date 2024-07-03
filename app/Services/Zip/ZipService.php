<?php

declare(strict_types=1);

namespace App\Services\Zip;

use App\Models\File;
use Illuminate\Support\Collection;
use ZipArchive;

class ZipService
{
    const ZIP_DIR = 'storage/';
    public function compress(Collection $files, string $zipTitle): string
    {
        $zip = new ZipArchive();

        $zipName = self::ZIP_DIR . $zipTitle;

        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        /**@var File $file*/
        foreach ($files as $file)
            $zip->addFile($file->absolutePath, $file->original_name);

        $zip->close();

        return $zipName;
    }
}