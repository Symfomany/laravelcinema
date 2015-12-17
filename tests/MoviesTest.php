<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MoviesTest extends TestCase
{


    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    public function setUp()
    {
        parent::setUp();


        // Avoid "Session store not set on request." - Exception!
        \Illuminate\Support\Facades\Session::setDefaultDriver('array');
        $this->manager = app('session');

        $user = \App\Http\Models\Administrators::where('email', 'julien2@meetserious.com')->first();
        \Illuminate\Support\Facades\Auth::setUser($user);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->markTestSkipped("Sorry...");

        $this->visit('/')
            ->see("We're Getting Ready To Launch!");
    }

    /**
     *  Test login
     */
    public function testAdmin()
    {
        $this->markTestSkipped("Sorry...");

        $this->visit('/admin')
            ->followRedirects()
            ->see("Email")
            ->see("Password");
    }


    /**
     *  Test login
     */
    public function testAuthentificationFailure()
    {
        $this->markTestSkipped("Sorry...");

        $this->visit('/auth/login')
            ->see("Email")
            ->see("Password")
            ->type('blabla@gmail.com', 'email')
            ->type('djscrave', 'password')
            ->press('Connexion')
            ->followRedirects()
            ->seePageIs('/auth/login');

    }
    /**
     *  Test login Success
     */
    public function testAuthentificationSuccess()
    {
        $this->markTestSkipped("Sorry...");

         $this->visit('/auth/login')
             ->withoutMiddleware()
             ->type('julien2@meetserious.com', 'email')
             ->type('123456', 'password')
             ->check('remember')
             ->press('Connexion')
             ->followRedirects()
             ->seePageIs('/admin');
    }

    /**
     *  Test login
     */
    public function testMoviesVisibleAndCover()
    {
        $this->markTestSkipped("Sorry...");

        $this->visit('/auth/login')
            ->withoutMiddleware()
            ->type('julien2@meetserious.com', 'email')
            ->type('123456', 'password')
            ->check('remember')
            ->press('Connexion')
            ->followRedirects()
            ->see('Dashboard')
            ->click('Gestion des films')
            ->seePageIs("admin/movies/index")
            ->see("Le seigneur des anneaux")
            ->get('http://localhost:8000/admin/movies/cover/1')
            ->followRedirects()
            ->see("Le film Le seigneur des anneaux a bien été retiré de l'avant")
            ->seeInDatabase('movies', ['id' => 1, 'cover' => 0])
            ->get('http://localhost:8000/admin/movies/activate/1')
            ->followRedirects()
            ->seeInDatabase('movies', ['id' => 1, 'visible' => 0]);
    }
    /**
     *  Test login
     */
    public function testMoviesCreateFailure()
    {


        $this
            ->withoutMiddleware()
            ->visit('/admin/movies/create');
//            ->seePageIs('/admin/movies/create')
//            ->type('z', 'title')
//            ->press('Enregistrer ce film');

    }


}
