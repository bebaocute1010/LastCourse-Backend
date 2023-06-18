<?php

namespace App\Console\Commands;

use App\Models\Warehouse;
use Illuminate\Console\Command;

class WarehouseSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:warehouseSeeder';

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
            Warehouse::create([
                "shop_id" => $i,
                "name" => "Kho hàng " . $i,
                "address" => "Số " . $i . ", Thanh Xuân - Hà Nội",
            ]);
        }
        return Command::SUCCESS;
    }
}
