<?php

namespace App\Http\Controllers;
use App\Http\Models\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


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
     * Auth
     */
    public function connect(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!empty($email) && !empty($password)) {
            $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
            $collection = new \MongoDB\Collection($manager, 'builders', 'account');


            if ($collection->count(["email" => $email]) == 0) {
                return response()->json(['data' => "User doesn't exist", 'state' => false]);
            }

            $user = $collection->findOne(["email" => $email])->bsonSerialize();

            if(password_verify($password, $user->password) == false){
                return response()->json(['data' => "Bad email or password", 'state' => false]);
            }

            $api = new Api($user);
            Auth::login($api);

            return response()->json(['data' => $user, 'state' => true]);

        } else {
            return response()->json(['data' => "Invalid parameters", 'state' => false]);
        }

        return response()->json(['data' => "Bad credentials", 'state' => false]);
    }

    /**
     * Auth
     */
    public function disconnect()
    {
        if (auth()->guard('api')->check()) {

            auth()->guard('api')->logout();

            return response()->json(['state' => true]);

        } else {

            return response()->json(['state' => false]);
        }

    }
    /**
     * Auth
     */
    public function connectAlreadyExist(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!empty($email) && !empty($password)) {
                $auth = auth()->guard('user');

                $credentials = [
                    'email' =>  $email,
                    'password' =>  $password,
                    'enabled' => true
                ];

                if ($auth->attempt($credentials) && auth()->guard('user')->check()) {

                    return response()->json(['data' => auth()->guard('user')->user()->toArray(), 'state' => true]);
                } else {
                    return response()->json(['data' => "Bad email or password", 'state' => false]);
                }

        } else {
            return response()->json(['data' => "Invalid parameters", 'state' => false]);
        }

        return response()->json(['data' => "Bad credentials", 'state' => false]);
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
