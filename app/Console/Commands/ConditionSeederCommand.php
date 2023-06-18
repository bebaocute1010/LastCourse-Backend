<?php

namespace App\Console\Commands;

use App\Models\ProductCondition;
use Illuminate\Console\Command;

class ConditionSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:conditionSeeder';

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
        for ($i = 0; $i < 100; $i++) {
            ProductCondition::create([
                "name" => "condition " . $i
            ]);
        }
        return Command::SUCCESS;
    }
}
