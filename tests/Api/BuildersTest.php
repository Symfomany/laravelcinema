<?php

/**
 * Class BuildersTest
 * Movies CRUD.
 */
class BuildersTest extends TestCase
{

    /**
     * Test Api for Create Account.
     */
    public function testCreateAccount()
    {
        $data = [
            "name" => "Test",
            "cp" => 75001,
            "phone" => "0601010101",
            "sexe" =>1,
            "news" => true,
            "email" => "test@free.fr",
        ];

        $this->post('/api/createaccount', $data)
        ->seeJson([
            'state' => true
        ])
        ->assertResponseOk();

        $this->post('/api/createaccount', $data)
            ->seeJson([
            'state' => false
        ]);


        $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
        $collection = new \MongoDB\Collection($manager, 'builders', 'account');
        $one = $collection->findOneAndDelete(["email" => $data["email"]]);
        $this->assertEquals($one->email, $data["email"]);

    }

    /**
     * Test Api for Create Account.
     */
    public function testconnectAccount()
    {
        $data = [
            "email" => "ludo@free.fr",
            "password" => "ifhdhuif",
        ];

        $this->post('/api/connect', $data)
        ->seeJson([
            'state' => false,
            'data' => "User doesn't exist",
        ])
        ->assertResponseOk();

        $data = [
            "val" => "ludov@meetserious.com",
        ];
        $this->post('/api/connect', $data)
            ->seeJson([
            'state' => false,
            'data' =>  "Invalid parameters"
        ]);

        $data = [
            "email" => "ludov@meetserious.com",
            "password" => "ifhdhuif",
        ];
        $this->post('/api/connect', $data)
            ->seeJson([
                'state' => false,
                'data' => 'Bad email or password'
            ]);


        $data = [
            "email" => "ludov@meetserious.com",
            "password" => "admin",
        ];
        $this->post('/api/connect', $data)
            ->seeJson([
                'state' => true
            ]);

    }

    /**
     * Test Api for Create Account.
     */
    public function testdisconnectAccount()
    {
        $this->get('/api/disconnect')
            ->seeJson([
                'state' => false
            ]);

        $data = [
            "email" => "ludov@meetserious.com",
            "password" => "admin",
        ];
        $this->post('/api/connect', $data)
            ->seeJson([
                'state' => true
            ]);

        $this->get('/api/disconnect')
            ->seeJson([
                'state' => false
            ]);

    }

}
