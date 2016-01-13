<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Task to send an email
 * Class Email.
 */
class Email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {email} {nom=Boyer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email for an use';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $nom = $this->argument('nom');
        Mail::send('Emails/welcome', [], function ($m) use ($email, $nom) {
            $m->to($email, $nom)
                ->subject('Welcome to the site ');
        });

        $this->info('Finish: Send a email');
    }
}
