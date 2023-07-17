<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getParentAttribute()
    {
        if ($this->parent_id === null) {
            return null;
        }

        return $this->belongsTo(Category::class, "parent_id")->first();
    }
}
