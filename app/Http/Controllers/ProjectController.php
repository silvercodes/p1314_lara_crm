<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Models\Project;
use App\Services\File\AbstractFileService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function get(Project $project)
    {
        return $project;
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
}
