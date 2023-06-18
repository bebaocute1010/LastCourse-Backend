<?php

namespace App\Console\Commands;

use App\Models\Carrier;
use Illuminate\Console\Command;

class CarrierSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:carrierSeeder';

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
            Carrier::create([
                "name" => "Đơn vị vận chuyển " . $i,
                "price" => 15000
            ]);
        }
        return Command::SUCCESS;
    }
}
