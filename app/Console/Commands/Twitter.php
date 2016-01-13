<?php

namespace App\Console\Commands;

use App\Model\Stats;
use App\Model\Tweets;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Task to register all tweets
 * Class Twitter.
 */
class Twitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Youtube import tweets on Mongo';

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
        $infos = \Thujohn\Twitter\Facades\Twitter::getUsersLookup(['screen_name' => 'Symfomany', 'format' => 'php']);

        if (!empty($infos)) {
            DB::connection('mongodb')->collection('stats')
                ->where(['origin' => 'Twitter', 'type' => 'infos'])->delete();

            $stat = new Stats();
            $stat->origin = 'Twitter';
            $stat->type = 'infos';
            $stat->data = $infos;
            $stat->save();
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getDmsOut(['format' => 'php']);
        if (!empty($tweets)) {
            DB::connection('mongodb')->collection('tweets')
                ->where(['origin' => 'Twitter', 'type' => 'dmsout'])
                ->delete();
            foreach ($tweets as $tweet) {
                $vi = new Tweets();
                $vi->origin = 'Twitter';
                $vi->type = 'dmsout';
                $vi->data = $tweet;
                $vi->save();
            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getFavorites(['format' => 'php']);
        if (!empty($tweets)) {
            DB::connection('mongodb')->collection('tweets')
                ->where(['origin' => 'Twitter', 'type' => 'favorites'])
                ->delete();
            foreach ($tweets as $tweet) {
                $vi = new Tweets();
                $vi->origin = 'Twitter';
                $vi->type = 'favorites';
                $vi->data = $tweet;
                $vi->save();
            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getMentionsTimeline(
            [
                'count'  => 15,
                'format' => 'php', ]);

        if (!empty($tweets)) {
            DB::connection('mongodb')->collection('tweets')
                ->where(['origin' => 'Twitter', 'type' => 'mentionstimeline'])
                ->delete();
            foreach ($tweets as $tweet) {
                $vi = new Tweets();
                $vi->origin = 'Twitter';
                $vi->type = 'mentionstimeline';
                $vi->data = $tweet;
                $vi->save();
            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getHomeTimeline(
            [
                'count'  => 15,
                'format' => 'php', ]);

        if (!empty($tweets)) {
            DB::connection('mongodb')->collection('tweets')
                ->where(['origin' => 'Twitter', 'type' => 'hometimeline'])
                ->delete();
            foreach ($tweets as $tweet) {
                $vi = new Tweets();
                $vi->data = $tweet;
                $vi->origin = 'Twitter';
                $vi->type = 'hometimeline';
                $vi->save();
            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getUserTimeline(
            [
                'screen_name' => 'allocine',
                'count'       => 15,
                'format'      => 'php', ]);

        if (!empty($tweets)) {
            DB::connection('mongodb')->collection('tweets')
                ->where(['origin' => 'Twitter', 'type' => 'usertimeline'])
                ->delete();
            foreach ($tweets as $tweet) {
                $vi = new Tweets();
                $vi->data = $tweet;
                $vi->origin = 'Twitter';
                $vi->type = 'usertimeline';
                $vi->save();
            }
        }
    }
}
