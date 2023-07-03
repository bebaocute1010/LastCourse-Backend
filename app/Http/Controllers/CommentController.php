<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentService;
use App\Utils\MessageResource;
use App\Utils\Uploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment_service;

    public function __construct()
    {
        $this->comment_service = new CommentService();
    }

    public function updateOrCreate(CreateCommentRequest $request)
    {
        $data_validated = $request->validated();
        if ($comment = $this->comment_service->updateOrCreate($data_validated, $id = $request->id)) {
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::COMMENT_CREATE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function delete(Request $request)
    {
        if ($request->id && $this->comment_service->delete($request->id)) {
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::COMMENT_DELETE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
