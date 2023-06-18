<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;

class ImageSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:imageSeeder';

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
            Image::create(["url" => "https://nyse.edu.vn/wp-content/uploads/2023/02/1676234185_Hinh-Anh-Avatar-Cute-Nam-Nu-Dang-Yeu-Xieu-Long-ACE.jpg"]);
        }
        return Command::SUCCESS;
    }
}
