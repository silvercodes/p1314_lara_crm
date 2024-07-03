<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\DownloadProjectFileRequest;
use App\Models\Project;
use App\Services\File\AbstractFileService;
use App\Services\Zip\ZipService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProjectController extends Controller
{
    const ZIP_FILE_NAME = "Project_files.zip";
    public function get(Project $project)
    {
        return $this->successResponse(data: $project->toArray());
    }
    public function store(CreateProjectRequest $request, AbstractFileService $fileService): JsonResponse
    {
        $project = new Project($request->validated());

        // save avatar file
        $avatar = $fileService->save($request['avatar']);
        $project->avatar_file_id = $avatar->id;

        $ts = $fileService->save($request['ts']);
        $project->ts_file_id = $ts->id;

        $project->save();

        return $this->successResponse(
            data: $project->toArray(),
            statusCode: Response::HTTP_CREATED,
        );
    }
    public function delete(Project $project, AbstractFileService $fileService)
    {
        $fileService->delete($project->avatarFile);
        $fileService->delete($project->tsFile);

        $project->delete();

        return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
    }

    public function download(
        Project $project,
        DownloadProjectFileRequest $request,
        AbstractFileService $fileService,
        ZipService $zipService
    ): BinaryFileResponse | StreamedResponse | null {
        switch ($request->validated('file'))
        {
            case Project::DOWNLOAD_FILE_AVATAR:
                return $fileService->getStream($project->avatarFile);
                break;
            case Project::DOWNLOAD_FILE_TS:
                return $fileService->getStream($project->tsFile);
                break;
                // TODO: FIX zip-ext
            case Project::DOWNLOAD_FILE_ZIP:
                $zip = $zipService->compress($project->getAllFiles(), self::ZIP_FILE_NAME);
                return response()->download($zip)->deleteFileAfterSend();
                break;
        }

        return null;    // TODO: throw exception
    }

}
