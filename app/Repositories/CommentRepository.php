<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function find($id)
    {
        return Comment::find($id);
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($id, array $data)
    {
        $comment = $this->find($id);
        $comment->update($data);
        return $comment;
    }
}
