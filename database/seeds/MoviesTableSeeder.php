<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Http\Models\Movies::class, 25)->create()->each(function($m) {
            $m->save();
        });

//        \Illuminate\Support\Facades\DB::table('movies')->insert([
//                'type' => "long-metrage",
//                'note_presse' => 4,
//                'title' => "Seed Movie Test",
//                'categories_id' => 1,
//                'trailer' => "<iframe></iframe>",
//                'languages' => "fr",
//                'distributeur' => "HBO",
//                'annee' => 2015,
//                'budget' => 6544548454,
//                'duree' => 4,
//                'synopsis' => str_repeat("blabla ",20),
//                'description' => str_repeat("blabla ",50),
//        ]);
    }
}
