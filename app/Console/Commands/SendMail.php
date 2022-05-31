<?php

namespace App\Console\Commands;

use App\Mail\RandomMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends an email in a random language to a random user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = array_slice(scandir(__DIR__ . '/../../../resources/lang'), 2);
        $locale = $files[array_rand($files)];
        App::setLocale($locale);
        $user = User::inRandomOrder()->first();
        $message = __('messages.welcome') . $user->name;
        $randomMail = new RandomMail($message);
        Mail::to($user->mail)->queue($randomMail);
        $this->info('Message: "' . $message . '" sent to ' . $user->email);
        return 0;
    }
}
