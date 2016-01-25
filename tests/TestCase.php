<?php


class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost:8000';

    /**
     * Authentifier un user.
     *
     * @return $this
     */
    public function authentification()
    {
        $this->visit('/login')
            ->type('julien2@meetserious.com', 'email')
            ->type('123456', 'password')
            ->check('remember')
            ->press('Connexion')
            ->followRedirects();

        return $this;
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
