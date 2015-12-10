<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MoviesRequest
 * Classe qui modélisera le formulaire de film
 * @package App\Http\Requests
 */
class MoviesRequest extends FormRequest
{
    /**
     * Retourne un tableau de validation par champ
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:long-metrage,court-metrage',
            'title' => 'required|min:5|unique:movies',
            'synopsis' => 'required|min:10|max:200',
            'description' => 'required|min:50',
            'date_release' => 'required|date_format:d/m/Y|after:now',
            'image' => 'required|image',
        ];
    }

    /**
     * Customisation des messages par champs
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute  est obligatoire',
            'min' => 'Ce champ doit faire plus de :min caractères',
            'max' => 'Ce champ doit faire moins de :max caractères',
            'integer' => 'Ce champ doit être un chiffre',
            'regex' => 'Mauvais format',
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
