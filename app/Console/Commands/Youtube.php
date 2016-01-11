<?php

namespace App\Console\Commands;

use App\Http\Models\Stats;
use App\Http\Models\Videos;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Alaouy\Youtube\Facades\Youtube as Yt;

/**
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
            DB::connection('mongodb')->collection('stats')
                ->where(['origin' => 'Youtube', 'type' => 'infos'])->delete();

            $stat = new Stats();
            $stat->origin = 'Youtube';
            $stat->type = 'infos';
            $stat->data = $channel;
            $stat->save();
        }

        $params = array(
            'q' => $keyword,
            'type' => 'video',
            'part' => 'id, snippet',
            'maxResults' => 30,
        );

        $videos = Yt::searchAdvanced($params, true)['results'];

        if (!empty($videos)) {
            DB::connection('mongodb')->collection('videos')->delete();
            foreach ($videos as $video) {
                $vi = new Videos();
                $vi->data = $video;
                $vi->save();
            }
        }

        Log::info("Import de l'API Youtube video done! ");
    }
}
