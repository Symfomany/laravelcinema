<?php
// chemin relatif ou se trouve la classe
namespace App\Http\Controllers;

use App\Http\Models\Administrators;
use App\Http\Requests\AdministratorsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Class AdministratorsController
 */
class AdministratorsController extends Controller{

    /**
     * Page de liste des administrateurs
     */
    public function index(){
        $administrators = Administrators::all();

        return view('Administrators/index',[
            'administrators' => $administrators
        ]);
    }


    /**
     * To remove an administrators
     * @param $id
     * @return mixed
     */
    public function remove($id){

        // To load an administrator
        $administrator = Administrators::find($id);

        if($administrator){
            Session::flash('success', "L'administrateur {$administrator->email} a bien été supprimé");
            $administrator->delete();
        }

        return Redirect::route('administrators_index');

    }


    /**
     * To remove an administrators
     * @param $id
     * @return mixed
     */
    public function create(){

        return view('Administrators/create');
    }
    /**
     * To remove an administrators
     * @param $id
     * @return mixed
     */
    public function store(AdministratorsRequest $request, $id = null){

        //creation
        if($id == null){
            $administrator = new Administrators();
        }else{
            $administrator = Administrators::find($id);
        }

        $administrator->firstname = $request->firstname;
        $administrator->lastname = $request->lastname;
        $administrator->email = $request->email;
        $administrator->description = $request->description;
        $administrator->password = bcrypt($request->password); //if en mode edit
        $administrator->super_admin =  $request->super_admin;
        $administrator->expiration_date = new \DateTime('+1 year');
        $administrator->active = true;

        //upload
        $filename = "";
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier
            $destinationPath = public_path() . '/uploads/administrators'; // Indique où stocker le fichier
            $file->move($destinationPath, $filename); // Déplace le fichier
            $administrator->photo = asset("uploads/administrators/". $filename);
        }

        $administrator->save();

       // Auth::login($administrator); => Autologin
        Session::flash('success', "L'administrateur {$administrator->email} a bien été crée");
        return Redirect::route('administrators_index');

    }




    /**
     * To edit an administrator
     * @param $id
     * @return mixed
     */
    public function edit($id){

        $administrator = Administrators::find($id);

        return view('Administrators/edit', [
            'administrator' => $administrator
        ]);
    }




}


















