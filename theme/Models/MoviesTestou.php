<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MoviesTestou
{

    use WithoutMiddleware;

    // https://openclassrooms.com/courses/decouvrez-le-framework-php-laravel/les-tests-unitaires-4


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->visit('/')
            ->see("We're Getting Ready To Launch!");
    }

    /**
     *  Test login
     */
    public function testAdmin()
    {

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
        $this->visit('/auth/login')
            ->see("Email")
            ->see("Password")
            ->type('blabla@gmail.com', 'email')
            ->type('djscrave', 'password')
            ->press('Connexion')
            ->followRedirects()
            ->see("Email")
            ->see("Password")
            ->seePageIs('/auth/login');

    }
    /**
     *  Test login Success
     */
    public function testAuthentificationSuccess()
    {
         $this->visit('/auth/login')
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

        $this->visit('/auth/login')
            ->type('julien2@meetserious.com', 'email')
            ->type('123456', 'password')
            ->check('remember')
            ->press('Connexion')
            ->followRedirects()
            ->see('Dashboard')
            ->click('Gestion des films')
            ->seePageIs("admin/movies/index")
            ->see("Le seigneur des anneaux")
            ->get('http://localhost:8000/admin/movies/cover/1') //get requet
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

        $this->markTestSkipped("Sorry...");

        $this
            ->visit('/admin/movies/create');
//            ->seePageIs('/admin/movies/create')
//            ->type('z', 'title')
//            ->press('Enregistrer ce film');

    }


}
