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
        $user = factory(\App\Http\Models\User::class)->create();

        $this->actingAs($user, 'api')
            ->get('/api/disconnect')
            ->seeJson([
                'state' => true
            ]);

    }


    /**
     * Test Api for Create Account.
     */
    public function testAddAnnounce()
    {
        $data = [
            'id' => 1,
            'title' => 'Product 1',
            'quantity' => 1,
            'prix' => 20.00,
            'options' => ['description' => "Description de la produit 1"],
        ];

        $request = $this->post('/api/addannounce', $data);
         $request->assertCount(1, \Illuminate\Support\Facades\Session::get('laracart.default')->items);
         $request->assertInstanceOf('LukePOLO\LaraCart\CartItem', \Illuminate\Support\Facades\Session::get('laracart.default')->items[0]);

    }


    public function testGetAnnounces(){

        $this->testAddAnnounce();
        $data = [
            'id' => 2,
            'title' => 'Product 2',
            'quantity' => 1,
            'prix' => 30.00,
            'options' => ['description' => "Description de la produit 2"],
        ];

        $request = $this->post('/api/addannounce', $data);
        $request->assertCount(2, \Illuminate\Support\Facades\Session::get('laracart.default')->items);

    }

    public function testAdAnnounces(){

        $path          = public_path('photos/photo.jpg');
        $original_name = 'photo.jpg';
        $mime_type     = 'image/jpg';
        $size          = 903000;
        $error         = null;
        $test          = true;

        $file = new \Symfony\Component\HttpFoundation\File\UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

        $this->call('POST', 'api/add', [], [], ['upload' => $file], []);

        $this->assertResponseOk();
    }


    public function testTotalAnnounces(){

        $this->get('/api/totalannounces')
            ->seeJson([
                'data' => ['total' => "0.00", "subtotal" =>"$0.00", "taxtotal" =>"0.00", "totaldiscount" => "0.00"],
                'state' => true
            ]);

    }

}
