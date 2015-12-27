<?php
/**
 * Class MoviesTest
 * Test Movies CRUD
 */
class MoviesTest extends TestCase
{


    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    use \Illuminate\Foundation\Testing\WithoutMiddleware;



    /**
     * Test Dashboard
     */
    public function testCreateFailure()
    {
//        $user = \App\Http\Models\Administrators::find(73);
//        $this->be($user); //You are now authenticated via l'administrator 73

//        exit(dump(\Illuminate\Support\Facades\Auth::user()));


        $this->visit('/admin/movies/create')
            ->type('s','title')
            ->press('Enregistrer ce film')
            ->followRedirects()
            ->seePageIs('/admin/movies/create')
            ->see('Ce champ doit faire plus de 5 caractères')
            ->see('date release  est obligatoire');
//            ->visit("/admin/movies/create");

    }

    /**
     * Test Remove Movies
     */
    public function testRemove(){
        $this->markTestSkipped();
        // methode permet l'authifictaion via un objet Administrator
        //Authentificatoo automatique via 'objet Administrateur (73)
        $user = \App\Http\Models\Administrators::find(73);
        $this->be($user); //You are now authenticated via l'administrator 73

        $this
            //->authentification()
            ->visit('/admin/movies/index')
//            ->click('Gestion des films')
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
        $this->markTestSkipped();

        $this->visit('/auth/login')
            ->withoutMiddleware()
            ->type('julien2@meetserious.com','email')
            ->type('123456','password')
            ->check('remember')
            ->press('Connexion')
            ->followRedirects()
            ->seePageIs('/admin')
//            ->click('Gestion des films')
            ->visit('/admin/movies/index')
            ->seePageIs('/admin/movies/index')
            ->see('Godzilla')
            //->assertEquals('movies_index', \Illuminate\Support\Facades\Request::route()->getName())
            ->get('http://localhost:8000/admin/movies/cover/3')
            ->followRedirects()
            ->seeInDatabase('movies', ['id' => 3, 'cover' => 0])
            ->get('http://localhost:8000/admin/movies/activate/3')
            ->followRedirects()
            ->seeInDatabase('movies', ['id' => 3, 'visible' => 0])
            ->see("Le film Godzilla a bien été retiré de l'avant")
            ->seePageIs('/admin/movies/index');
            //get() faire une requete en GET


        //je peux appeler un test dans un autre

//        $this->seePageIs('/admin');
    }



}
