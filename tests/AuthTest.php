<?php


/**
 * Class AuthTest
 * Test AUthentification mecanisme.
 */
class AuthTest extends TestCase
{
    //use WithoutMiddleware;

    /**
     * Test Login Page.
     */
    public function testAuthPage()
    {
        // visit test si la page est OKAY
        // et si je me trouve dans l'uri /ogin
        $this->visit('/login')
        // code 200 : Bon fonctionement de la page
             ->see('Email') // see permet de voir un element HTML
             ->see('Password');
    }

    /**
     * Test si mécanisme de login échoue.
     */
    public function testLoginFailure()
    {
        $this->visit('/login')
            // type() permet de remplir un champs
             ->type('toto@free.fr', 'email')
             ->type('tata', 'password')
            // press() permey de cliquer sur un boutton
             ->press('Connexion')

            // suivre la redirection
             ->followRedirects()
             ->see('Email')
             ->see('Password')

            // si la page courante est égale à unr URI
             ->seePageIs('/login');
    }

    public function testLoginSuccess()
    {
        $this->visit('/login')
            ->withoutMiddleware()
            // On désactrive le middleware
            // pour que la sécurité ne prenne pas
            // en compte le CSRF lors de l'authentification
            //
            ->type('julien2@meetserious.com', 'email')
            ->type('123456', 'password')
            ->check('remember')
            ->press('Connexion')
            // suivre la redirection
            ->followRedirects()
            ->seePageIs('/admin')
            ->dontsee('Password');
    }

    /**
     * Test Dashboard.
     */
    public function testDashboard()
    {
        $this->testLoginSuccess();
        //je peux appeler un test dans un autre

        $this->see('Répartition des films par catégories');
        $this->see('50 ans');
    }
}
