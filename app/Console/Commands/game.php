<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class game extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game';

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
        $number = $this->ask('Enter the number');
        $computerNumber = rand(0, 10);
        $this->line('My number is: ' . $computerNumber);
        if ($number > $computerNumber) {
            $this->info('YOU WON!');
        } else {
            $this->error('YOU LOSE!');
        }

        return 0;
    }
}
