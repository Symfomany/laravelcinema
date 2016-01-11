<?php

namespace App\Console\Commands;

use App\Http\Models\Movies;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class LastMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email for suscribers to last movies this last month';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // SQL query
        $results = Movies::where('date_release', '>=', new Carbon('-1 month'))
                        ->where('date_release', '<=', new Carbon('now'))
                        ->get();

        // je parcours mes films
        foreach ($results as $movie) {
            $users = $movie->actors();
            foreach ($users as $user) {
                //send an email
                Mail::send('Emails/newsletter', [], function ($m) {

                    $m->from('julien@meetserious.com', 'Florent Boyer');
                    $m->to('zuzu38080@gmail.com', 'Boyer Julien')
                        ->subject('Welcome to newsletter');
                });
            }
        }
    }
}
