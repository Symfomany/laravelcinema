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

        try{
            $collection->insertOne($stat);
        }catch (\Exception $e){
            return response()->json(['state' => false]);
        }

        $data["email"] = $request->email;
        return response()->json(['data' => $data, 'state' => true]);
    }

    /**
     * List account
     */
    public function listAccount()
    {
        $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
        $collection = new \MongoDB\Collection($manager, 'builders', 'account');

        $result = $collection->find()->toArray();

        $tab = [];
        foreach($result as $one){
            $tab[] = $one->bsonSerialize();
        }

        return response()->json($tab);
    }

    /**
     * Update account
     */
    public function updateAccount(Request $request)
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

        try{
            $collection->updateOne(["email" => $request->email], $stat);
        }catch (\Exception $e){
            return response()->json(['state' => false]);
        }

        $data["email"] = $request->email;
        return response()->json(['data' => $data, 'state' => true]);
    }

}
