<?php

namespace App\Repositories;

use App\Models\ProductCondition;

class ProductConditionRepository
{
    public function getConditions()
    {
        return ProductCondition::all();
    }
}
