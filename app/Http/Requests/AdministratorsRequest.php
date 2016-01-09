<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdministratorsRequest
 * Classe qui modélisera le formulaire d'administrateurs
 * @package App\Http\Requests
 */
class AdministratorsRequest extends FormRequest
{


    /**
     * Retourne un tableau de validation par champ
     * @return array
     */
    public function rules()
    {
        // Je viens recupérer mon id en URL si je suis en mode edition
        // Depuis ma route, je peux récupérer un argument "id"
        $id = $this->route('id');

        // Création d'administrateur
        if($id === null) {
            return [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'description' => 'required|min:10',
                'email' => 'required|email|max:255|unique:administrators',
                'password' => 'required|confirmed|min:6',
                'image' => 'required|image',
            ];
        }
        // Edition administrateur
        else{
            return [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'description' => 'required|min:10',
                'email' => 'required|email|max:255|unique:administrators,email,' . $id,
                'password' => 'confirmed|min:6',
                'image' => 'image',
            ];
        }
    }

    /**
     * Customisation des messages par champs
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Un titre pour le film!',
            'required' => ':attribute  est obligatoire',
            'min' => 'Ce champ doit faire plus de :min caractères',
            'max' => 'Ce champ doit faire moins de :max caractères',
            'integer' => 'Ce champ doit être un chiffre',
            'regex' => ':attribute a un mauvais format',
            'date_format' => 'Le format de date doit etre valide',
            'image' => "Le format de l'image est invalide",
        ];
    }


    /**
     * Autoriser l'accès de mon formulaire
     * pour tout utilisateur
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


}
