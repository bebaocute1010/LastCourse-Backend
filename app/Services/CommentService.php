<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class CommentService
{
    private $comment_repository;
    private $product_service;
    private $bill_detail_service;
    private $uploader;

    public function __construct()
    {
        $this->comment_repository = new CommentRepository();
        $this->product_service = new ProductService();
        $this->bill_detail_service = new BillDetailService();
        $this->uploader = new Uploader();
    }

    public function delete($id)
    {
        if ($comment = $this->comment_repository->find($id)) {
            $this->uploader->deleteImages($comment->image_ids);
            $this->product_service->updateRating($comment->product_id);
            return $comment->delete();
        }
        return false;
    }

    public function updateOrCreate(array $data, $id = null)
    {
        $detail = $this->bill_detail_service->find($data["detail_id"]);
        $data = array_merge($data, [
            "user_id" => auth()->id(),
            "image_ids" => isset($data["images"]) ? $this->uploader->getImageIds($data["images"]) : [],
            "bill_id" => $detail->bill_id,
            "product_id" => $detail->product_id,
        ]);
        Arr::forget($data, ["images", "detail_id"]);

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
