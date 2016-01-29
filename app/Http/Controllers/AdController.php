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

    public function addAnnounce(Request $request){

        $file = null;


        // Build the input for our validation
        $input = array('image' => Input::file('image'));

        // Within the ruleset, make sure we let the validator know that this
        // file should be an image
        $rules = array(
            'image' => 'image'
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($input, $rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
            return response()->json(['data' => 'Fichier invalid', 'state' => false]);
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier
                $destinationPath = public_path().'/uploads/ad'; // Indique où stocker le fichier
                $file->move($destinationPath, $filename); // Déplace le fichier
                return response()->json(['data' => asset($filename), 'state' => true]);
            }
        }


    }


}
