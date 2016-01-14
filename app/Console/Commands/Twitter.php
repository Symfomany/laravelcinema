<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Task to register all tweets
 * Class Twitter.
 */
class Twitter extends Command
{

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'twitter:import';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Twitter import tweets on Mongo';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $infos = \Thujohn\Twitter\Facades\Twitter::getUsersLookup(['screen_name' => 'Symfomany', 'format' => 'php']);
        $manager = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
        $collection = new \MongoDB\Collection($manager, "laravel.tweets");

        if (!empty($infos)) {

            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'infos']);

            $stat = [
                "origin"    => "Twitter",
                "type"    => "infos",
                "data" => $infos,
                "created" => new  \MongoDB\BSON\UTCDatetime(time()),
            ];
            $collection->insertOne($stat);

        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getDmsOut(['format' => 'php']);
        if (!empty($tweets)) {
            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'dmsout']);

            foreach ($tweets as $tweet) {
                $stat = [
                    "origin"    => "Twitter",
                    "type"    => "dmsout",
                    "data" => $tweet,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time()),
                ];
                $collection->insertOne($stat);
            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getFavorites(['format' => 'php']);
        if (!empty($tweets)) {
            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'favorites']);

            foreach ($tweets as $tweet) {

                $stat = [
                    "origin"    => "Twitter",
                    "type"    => "favorites",
                    "data" => $tweet,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time()),
                ];
                $collection->insertOne($stat);

            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getMentionsTimeline(
            [
                'count' => 15,
                'format' => 'php', ]);

        if (!empty($tweets)) {
            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'mentionstimeline']);


            foreach ($tweets as $tweet) {

                $stat = [
                    "origin"    => "Twitter",
                    "type"    => "mentionstimeline",
                    "data" => $tweet,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time()),
                ];
                $collection->insertOne($stat);

            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getHomeTimeline([
                'count' => 15,
                'format' => 'php'
            ]);

        if (!empty($tweets)) {
            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'hometimeline']);

            foreach ($tweets as $tweet) {

                $stat = [
                    "origin"    => "Twitter",
                    "type"    => "hometimeline",
                    "data" => $tweet,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time()),
                ];
                $collection->insertOne($stat);

            }
        }

        $tweets = \Thujohn\Twitter\Facades\Twitter::getUserTimeline([
                'screen_name' => 'allocine',
                'count' => 15,
                'format' => 'php'
            ]);

        if (!empty($tweets)) {
            $collection->deleteMany(['origin' => 'Twitter', 'type' => 'usertimeline']);

            foreach ($tweets as $tweet) {

                $stat = [
                    "origin"    => "Twitter",
                    "type"    => "usertimeline",
                    "data" => $tweet,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time()),
                ];
                $collection->insertOne($stat);

            }
        }
    }
}
