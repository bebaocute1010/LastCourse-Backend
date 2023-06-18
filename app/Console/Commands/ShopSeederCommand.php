<?php

namespace App\Console\Commands;

use App\Models\Shop;
use Illuminate\Console\Command;

class ShopSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:shopSeeder';

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
            Shop::create([
                "user_id" => $i,
                "name" => "SHOP " . $i,
                "avatar" => $i,
                "created_at" => now(),
                "deleted_at" => now()
            ]);
        }
        return Command::SUCCESS;
    }
}
