<?php
/**
 * Class MoviesTest
 * Test Movies CRUD
 */
class MoviesTest extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;


    /**
     * Test Dashboard
     */
    public function testCreateFailure()
    {
        $this->authentification()
            ->visit('/admin/movies/create')
            ->type('s','title')
            ->type('bla','description')
            ->press('Enregistrer ce film')
            ->followRedirects()
            ->seePageIs('/admin/movies/create')
            ->see('Ce champ doit faire plus de 5 caractères')
            ->see('Ce champ doit faire plus de 50 caractères')
            ->see('date release  est obligatoire');
    }

    /**
     * Test Dashboard
     */
    public function testCreateSuccess()
    {
        $this->authentification()
            ->visit('/admin/movies/create')
            ->type('Test de mon premier film!','title')
            ->type(2012,'annee')
            ->type("Warner Bros",'distributeur')
            ->type(1515145.00,'budget')
            ->type(4,'duree')
            ->type(3,'note_presse')
            ->type("<iframe src='//youtube.com'></iframe>",'trailer')
            ->type(str_repeat("bla ", 50),'synopsis')
            ->type(str_repeat("bla ", 20),'description')
            ->type("16/03/2017",'date_release')
            ->attach(asset("uploads/movies/"),'image')
            ->select('long-metrage','type')
            ->select('fr','lang')
            ->select('vost','bo')
            ->press('Enregistrer ce film')
            ->followRedirects()
            ->seePageIs('/admin/movies/index');
    }

    /**
     * Test Dashboard
     */
    public function testEditFailure()
    {
        $this->authentification()
            ->visit('/admin/movies/edit/3')
            ->type('Django Unchained','title')
            ->type("16/03/2014",'date_release')
            ->press('Enregistrer ce film')
            ->followRedirects()
            ->see('La valeur du champ Titre est déjà utilisée.')
            ->see('Le champ date release doit être une date postérieure au now.')
            ->seePageIs('/admin/movies/edit/3');
    }

    /**
     * Test Remove Movies
     */
    public function testRemove(){
        //$this->markTestSkipped();
        $this
            ->authentification()
            ->visit('/admin/movies/index')
            ->get('http://localhost:8000/admin/movies/delete/3')
            ->followRedirects()
            ->notSeeInDatabase('movies', ['id' => 3])
            ->see("Le film Godzilla a bien été supprimé");
    }

    /**
     * Test Dashboard
     */
    public function testActivateAndCover()
    {
        //$this->markTestSkipped();

        $this->authentification()
            ->visit('/admin/movies/index')
            ->seePageIs('/admin/movies/index')
            ->see('Godzilla')
           // ->assertEquals('movies_index', \Illuminate\Support\Facades\Request::route()->getName())
            ->get('http://localhost:8000/admin/movies/cover/3')
            ->followRedirects()
            ->seeInDatabase('movies', ['id' => 3, 'cover' => 0])
            ->get('http://localhost:8000/admin/movies/activate/3')
            ->followRedirects()
            ->seeInDatabase('movies', ['id' => 3, 'visible' => 0])
            //->see("Le film Godzilla a bien été retiré de l'avant")
            ->seePageIs('/admin/movies/index');
    }



}
