<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


/**
 * Class AdController.
 */
class AdController extends Controller
{

    public function adAnnounce(Request $request){

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "description" => $request->description,
            "chambres" => $request->chambres,
            "pieces" => $request->pieces,
            "surface" => $request->surface,
            "prix" => $request->prix,
            "aid" => $request->aid
        ];

        $file = null;
        $data["email"] = $request->email;

        $input = array('image' => Input::file('image'));

        $rules = array(
            'image' => 'image'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return response()->json(['data' => 'Fichier invalid', 'state' => false]);
        } else {
            if ($request->hasFile('image')) {


                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $destinationPath = public_path().'/uploads/ad';
                $file->move($destinationPath, $filename);

                $data['image'] = asset($filename);

                $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
                $collection = new \MongoDB\Collection($manager, 'builders', 'ads');
                $stat = [
                    'email'    => $request->email,
                    'data'    => $data,
                    'created' => new  \DateTime("now"),
                ];

                try{
                    $collection->insertOne($stat);
                } catch (\Exception $e){
                    return response()->json(['state' => false]);
                }

                return response()->json(['data' => $data, 'state' => true]);

            }
        }


    }



    /**
     * List ads
     */
    public function ads()
    {
        $manager = new \MongoDB\Driver\Manager('mongodb://localhost:27017');
        $collection = new \MongoDB\Collection($manager, 'builders', 'ads');

        $result = $collection->find()->toArray();

        $tab = [];
        foreach($result as $one){
            $tab[] = $one->bsonSerialize();
        }

        return response()->json($tab);
    }


}
