<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Nette\Utils\Random;

class UserSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:userSeeder';

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
            User::create([
                "email" => "tranduc" . $i . "@gmail.com",
                "username" => "tranducne" . $i,
                "password" => "11111111",
                "fullname" => "Trần Xuân Đức " . $i,
                "avatar" => $i,
                "birthday" => now(),
                "gender" => 0,
                "invite_code" => "qweqweq" . $i,
                "email_verified_at" => now(),
            ]);
        }
        return Command::SUCCESS;
    }
}
