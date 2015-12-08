<?php



/**
 * Pages Accueil
 * uses => appel le nom du controlleur
 * et l'action du controller
 */
Route::get('/', [

    'uses' => 'MainController@index'
]);


/**
 * BackOffice
 */
Route::group(['prefix' => 'admin'], function () {


    /**
     * Routes de Movies
     */
    Route::group(['prefix' => 'movies'], function () {

        /**
         * Page index: liste des films
         */
        Route::get('/index', [

            'uses' => 'MoviesController@index'
        ]);

        /**
         * Page create: création d'un film
         */
        Route::get('/create', [

            'uses' => 'MoviesController@create'
        ]);

        /**
         * Page read: voir un film
         */
        Route::get('/read', [

            'uses' => 'MoviesController@read'
        ]);

        /**
         * Page edit: editer un film
         */
        Route::get('/edit', [

            'uses' => 'MoviesController@edit'
        ]);

        /**
         * Delete: Suppression d'un film
         */
        Route::get('/delete', [

            'uses' => 'MoviesController@delete'
        ]);
    });


// CRUD de categories
    Route::group(['prefix' => 'categories'], function () {

        Route::get('/index', [

            'uses' => 'CategoriesController@index'
        ]);


        Route::get('/create', [

            'uses' => 'CategoriesController@create'
        ]);

        Route::get('/edit', [

            'uses' => 'CategoriesController@edit'
        ]);

        Route::get('/delete', [

            'uses' => 'CategoriesController@delete'
        ]);

    });
// CRUD de categories
    Route::group(['prefix' => 'actors'], function () {

        Route::get('/index', [

            'uses' => 'ActorsController@index'
        ]);


        Route::get('/create', [

            'uses' => 'ActorsController@create'
        ]);

        Route::get('/edit', [

            'uses' => 'ActorsController@edit'
        ]);

        Route::get('/delete', [

            'uses' => 'ActorsController@delete'
        ]);

    });

// CRUD de categories
    Route::group(['prefix' => 'directors'], function () {

        Route::get('/index', [

            'uses' => 'DirectorsController@index'
        ]);


        Route::get('/create', [

            'uses' => 'DirectorsController@create'
        ]);

        Route::get('/edit', [

            'uses' => 'DirectorsController@edit'
        ]);

        Route::get('/delete', [

            'uses' => 'DirectorsController@delete'
        ]);

    });


});

//
//
//Route::get('/categories', [
//
//    'uses' => 'CategoriesController@index'
//]);


// Actors et Directors


/**************************** Pages Statiques ********************************/


/**
 * Page FAQ
 */
Route::get('/faq', function () {

    return view('Pages/faq');
});


/**
 * Page about
 */
Route::get('/about', function () {

    // retourne le nom de la vue
    return view('Pages/about');
});


/**
 * Pages concept
 */
Route::get('/concept', function () {

    // retourne le nom de la vue
    return view('Pages/concept');
});

// /about & /concept




