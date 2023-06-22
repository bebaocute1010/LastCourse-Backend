<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class CommentService
{
    private $comment_repository;
    private $product_service;
    private $uploader;

    public function __construct()
    {
        $this->comment_repository = new CommentRepository();
        $this->product_service = new ProductService();
        $this->uploader = new Uploader();
    }

    public function updateOrCreate(array $data, $id = null)
    {
        $data["user_id"] = 1; //Sau nay sua thanh auth()->id()
        $data["image_ids"] = isset($data["images"]) ? $this->uploader->getImageIds($data["images"]) : [];
        Arr::forget($data, "images");

        if (!$id) {
            $comment_updated = $this->comment_repository->create($data);
        } else {
            if ($comment = $this->comment_repository->find($id)) {
                $this->uploader->deleteImages($comment->image_ids);
                $comment_updated = $this->comment_repository->update($comment->id, $data);
            }
        }
        if ($comment_updated) {
            $this->product_service->updateRating($comment_updated->product_id);
            return $comment_updated;
        }
        return false;
    }
}
