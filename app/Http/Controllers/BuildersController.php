<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


/**
 * Class BuildersController.
 */
class BuildersController extends Controller
{

    /**
     * Create account
     */
    public function createAccount(Request $request)
    {
        $data = [
          "name" => $request->name,
          "cp" => $request->cp,
          "phone" => $request->phone,
          "sexe" => $request->sexe,
          "news" => $request->news,
        ];

        $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
        $collection = new \MongoDB\Collection($manager, 'builders', 'account');
        $stat = [
            'email'    => $request->email,
            'data'    => $data,
            'created' => new  \DateTime("now"),
        ];
        $collection->insertOne($stat);

        return response()->json(['data' => true, 'state' => true]);
    }

}
