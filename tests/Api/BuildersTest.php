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

}
