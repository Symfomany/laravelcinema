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
     *
     * @return void
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
        /*
         *  php5-cli php5-common php5-curl php5-gd
         *  php5-imap php5-intl php5-json php5-mcrypt php5-mysql php5-pspell
         *  php5-readline php5-sqlite
         */

        // SQL query
        $results = Movies::where('date_release','>=', new Carbon('-1 month'))
                        ->where('date_release','<=', new Carbon('now'))
                        ->get();

        // je parcours mes films
        foreach($results as $movie){

            dump($movie->id);
            $users = $movie->actors();
            exit(dump(($movie->actors())));

            // je parcours les favoris(user) de chaque film
            foreach($users as $user){
                dump($user);
                exit('stop');

            }

        }
        exit('TOP');

        //send an email
        Mail::send('Emails/newsletter', [], function ($m) {

            $m->from('julien@meetserious.com', 'Florent Boyer');
            $m->to("zuzu38080@gmail.com", "Boyer Julien")
                ->subject('Welcome to newsletter');
        });
    }
}
