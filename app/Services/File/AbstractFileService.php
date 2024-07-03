<?php

declare(strict_types=1);

namespace App\Services\File;

use App\Exceptions\ApiNotFoundException;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 *
 */
abstract class AbstractFileService
{
    /**
     * @param UploadedFile $file
     * @return File
     */
    abstract function save(UploadedFile $file): File;

    /**
     * @param File $file
     * @return bool
     */
    abstract function delete(File $file): bool;

    /**
     * @param File $file
     * @return StreamedResponse
     * @throws ApiNotFoundException
     */
    public function getStream(File $file): StreamedResponse
    {
        if (Storage::exists($file->path))
            return Storage::download($file->path, $file->original_name);

        throw new ApiNotFoundException("File not found");
    }
}
