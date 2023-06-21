<?php

namespace Database\Seeders;

use App\Models\ProductCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            ProductCondition::updateOrCreate([
                "name" => "condition " . $i
            ]);
        }
    }
}
