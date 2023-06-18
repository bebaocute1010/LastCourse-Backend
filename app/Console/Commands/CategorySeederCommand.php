<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CategorySeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:categorySeeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Category::create([
            "name" => "Category cha",
        ]);
        for ($i = 1; $i < 10; $i++) {
            Category::create([
                "name" => "Category con " . $i,
                "parent_id" => 0
            ]);
        }
        return Command::SUCCESS;
    }
}
