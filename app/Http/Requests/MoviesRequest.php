<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MoviesRequest
 * Classe qui modélisera le formulaire de film.
 */
class MoviesRequest extends FormRequest
{
    /**
     * Retourne un tableau de validation par champ.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:long-metrage,court-metrage',
            'title' => 'required|min:5|unique:movies',
            'synopsis' => 'required|min:10|max:2000',
            'description' => 'required|min:50',
            'date_release' => 'required|date_format:d/m/Y|after:now',
            'image' => 'image',
            'lang' => 'required|in:fr,en,es,it',
            'bo' => 'required|in:vf,vo,vost,vostfr',
            'annee' => 'required|regex:/^[0-9]{4}$/',
            'distributeur' => 'required|regex:/^[a-zA-Z0-9\_\- ]{3,}$/',
            'budget' => 'required|regex:/\d+(\.\d{1,2})?/',
            'duree' => 'required|integer',
            'trailer' => 'regex:/(iframe)/i',
            'note_presse' => 'required|between:1,5',
        ];
    }

    /**
     * Customisation des messages par champs.
     *
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
     * pour tout utilisateur.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
