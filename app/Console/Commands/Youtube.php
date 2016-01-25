<?php

namespace App\Console\Commands;

use Alaouy\Youtube\Facades\Youtube as Yt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Task to register Youtube API Videos
 * Class Youtube.
 */
class Youtube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:import {keyword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Youtube import videos on Mongo';

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
        $keyword = $this->argument('keyword');

        $channel = Yt::getChannelByName('allocine');

        if (!empty($channel)) {
            $manager = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
            $collection = new \MongoDB\Collection($manager, "laravel.stats");
            $collection->deleteMany([]);

            $collection = new \MongoDB\Collection($manager, "laravel.stats");
            $stat = [
                "origin"    => "Youtube",
                "type"    => "search",
                "data" => $channel,
                "created" => new  \MongoDB\BSON\UTCDatetime(time()),
            ];
            $collection->insertOne($stat);
        }

        $params = [
            'q' => $keyword,
            'type' => 'video',
            'part' => 'id, snippet',
            'maxResults' => 30,
        ];

        $videos = Yt::searchAdvanced($params, true)['results'];

        if (!empty($videos)) {
            $collection = new \MongoDB\Collection($manager, "laravel.videos");
            $collection->deleteMany([]);
            $now = new \DateTime();

            foreach ($videos as $video) {
                $collection = new \MongoDB\Collection($manager, "laravel.videos");
                $stat = [
                    "data"    => $video,
                    "created" => new  \MongoDB\BSON\UTCDatetime(time())
                ];
                $collection->insertOne($stat);
            }
        }

        Log::info("Import de l'API Youtube video done! ");
    }
}
