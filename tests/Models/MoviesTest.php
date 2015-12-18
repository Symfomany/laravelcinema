<?php



/**
 * Class MoviesTest
 * @package Test\Models
 */
class MoviesTest extends TestCase {


    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $movie = new \App\Http\Models\Movies();
        $movie->title= "Star Wars 3";

        $this->assertInstanceOf(\App\Http\Models\Movies::class, $movie);
        $this->assertEquals($movie->title, "Star Wars 3");
        $this->assertClassHasAttribute("table", \App\Http\Models\Movies::class);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateInDatabase()
    {
        $movie = new \App\Http\Models\Movies();
        $movie->title= "Star Wars 3";
        $movie->save();
        $this->seeInDatabase('movies', ["title" => "Star Wars 3"]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateInDatabase()
    {
        $movie = \App\Http\Models\Movies::where("title" , "=", "Star Wars 3")->first();
        $this->seeInDatabase('movies', ["title" => "Star Wars 3"]);

        $movie->title =  "Star Wars 4";
        $movie->categories_id =  1;
        $movie->save();
        $this->seeInDatabase('movies', ["title" => "Star Wars 4"]);

    }
//
//
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testRemoveInDatabase()
//    {
//        $movie = \App\Http\Models\Movies::where("title" , "=", "Star Wars 4")->first();
////        $movie->delete();
//
//        $this->dontSeeInDatabase('movies', ["title" => "Star Wars 4"]);
//
//    }
//
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testGetAllMovies()
//    {
//        $movie = new \App\Http\Models\Movies();
//        $movies = $movie->getAllMovies();
//        $this->assertInternalType("array", $movies);
//
//
//    }
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testGetAvgNotePresse()
//    {
//        $movie = new \App\Http\Models\Movies();
//        $avg = $movie->getAvgNotePresse();
//        $this->assertInternalType("object", $avg);
//        $this->assertEquals(1,count($avg));
//        $this->assertInstanceOf("stdClass",$avg);
//
//    }
//
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testActors()
//    {
//        $movie = new \App\Http\Models\Movies();
//        $actors = $movie->actors();
//        $this->assertInstanceOf("Illuminate\Database\Eloquent\Relations\BelongsToMany",$actors);
//
//    }
//
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testCategories()
//    {
//        $movie = new \App\Http\Models\Movies();
//        $movie->title =  "Star Wars 4";
//        $movie->categories_id =  1;
//        $movie->save();
//
//        $categorie = $movie->categories();
//        dump($categorie->title);
////        dump($categorie);
////        $this->assertInstanceOf("Illuminate\Database\Eloquent\Relations\BelongsTo",$categorie);
//        $this->assertInternalType("string", $categorie->title);
//        $this->assertEquals("Fantastique", $categorie->title);
////        $this->assertEquals(1, count($movie->categories()));
//
//    }

}







