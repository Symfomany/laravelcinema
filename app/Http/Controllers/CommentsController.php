<?php

namespace App\Http\Controllers;

use App\Http\Models\Comments;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;



/**
 * Class CategoriesController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{


    /* ##################### METHODES ##################### */


    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $datas = [
            'comments' => Comments::all()
        ];

        $comment= new Comments();
        $datas['bestCommenter'] = $comment->bestCommenter();

        return view('Comments/index', $datas);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Comments/create');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function read($id)
    {
        return view('Comments/read', ['id' => $id]);

    }

    /**
     *
     */
    public function update(Request $request)
    {
        $field = 'content';

        $id = $request->id;
        $value = $request->value;

        $comment = Comments::find($id);
        $comment->update([$field => $value]);
//        Session::flash('success', "Le commentaire a bien été mis à jour");
//        return Redirect::route('comments.index');
    }

    /**
     * Pour la suppression, il n'y a pas de vue dédiée.
     * On redirige donc vers l'index.
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        return redirect('/comments', ['id' => $id]);

    }

    public function search()
    {
        return view('Comments/search');
    }

    public function favoris(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action');
        // Récupération en session de l'item "favoris"
        $liked = session("commentsFavoris", []);

        if ($action == "add") {

            // Enregistrement en variable de l'id souhaité
            $liked[] = $id;
            // Stockage de cette variable de la session
            Session::put("commentsFavoris", $liked);


        } else {

            // On cherche la position de l'id dans le tableau
            $position = array_search($id, $liked);
            // On supprime l'élément grâce à sa position
            unset($liked[$position]);

            // Stockage de cette variable de la session
            Session::put("commentsFavoris", $liked);
        }

        (dump(session("commentsFavoris")));

    }


}