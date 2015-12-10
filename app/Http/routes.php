<?php



/**
 * Pages Accueil
 * uses => appel le nom du controlleur
 * et l'action du controller
 */
Route::get('/', [
    'as' => 'homepage',
    'uses' => 'MainController@index'
]);


/**
 * BackOffice
 */
Route::group(['prefix' => 'admin'], function () {




    /**
     * CRUD de Movies
     */
    Route::group(['prefix' => 'movies'], function () {

        /**
         * Page index: liste des films
         */
        Route::get('/index', [
            'as' => 'movies_index',
            'uses' => 'MoviesController@index'
        ]);

        /**
         * Page create: création d'un film
         */
        Route::get('/create', [
            'as' => 'movies_create',
            'uses' => 'MoviesController@create'
        ]);

        /**
         * Store movies in database from form
         */
        Route::post('/store', [
            'as' => 'movies_store',
            'uses' => 'MoviesController@store'
        ]);


        /**
         * Page read: voir un film
         */
        Route::get('/read/{id}', [
            'as' => 'movies_read',
            'uses' => 'MoviesController@read'
        ])->where('id', '[0-9]+');


        /**
         * Page edit: editer un film
         */
        Route::get('/edit/{id}', [
            'as' => 'movies_edit',
            'uses' => 'MoviesController@edit'
        ])->where('id', '[0-9]+');

        /**
         * Delete: Suppression d'un film
         */
        Route::get('/delete/{id}', [
            'as' => 'movies_delete',
            'uses' => 'MoviesController@delete'
        ])->where('id', '[0-9]+');


        /**
         * Activate: Activer un film
         */
        Route::get('/activate/{id}', [
            'as' => 'movies_activate',
            'uses' => 'MoviesController@activate'
        ])->where('id', '[0-9]+');



        /**
         * Cover: Mise en avant d'un film
         */
        Route::get('/cover/{id}', [
            'as' => 'movies_cover',
            'uses' => 'MoviesController@cover'
        ])->where('id', '[0-9]+');




    });




// CRUD de categories
    Route::group(['prefix' => 'categories'], function () {

        Route::get('/index', [
            'as' => 'categories_index',
            'uses' => 'CategoriesController@index'
        ]);


        Route::get('/create', [
            'as' => 'categories_create',
            'uses' => 'CategoriesController@create'
        ]);

        /**
         * Store movies in database from form
         */
        Route::post('/store', [
            'as' => 'categories_store',
            'uses' => 'CategoriesController@store'
        ]);


        /**
         * Editer prendra un argument id en URL
         */
        Route::get('/read/{id}', [
            'as' => 'categories_read',
            'uses' => 'CategoriesController@read'
        ])->where('id', '[0-9]+');

        /**
         * Editer prendra un argument id en URL
         */
        Route::get('/edit/{id}', [
            'as' => 'categories_edit',
            'uses' => 'CategoriesController@edit'
        ])->where('id', '[0-9]+');

        /**
         * Supprimer prendra un argument id en URL
         */
        Route::get('/delete/{id}', [
            'as' => 'categories_delete',
            'uses' => 'CategoriesController@delete'
        ])->where('id', '[0-9]+');

    });



// CRUD de actors
    Route::group(['prefix' => 'actors'], function () {

        Route::get('/index', [
            'as' => 'actors_index',
            'uses' => 'ActorsController@index'
        ]);


        Route::get('/create', [
            'as' => 'actors_create',
            'uses' => 'ActorsController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'actors_edit',
            'uses' => 'ActorsController@edit'
        ])->where('id', '[0-9]+');

        Route::get('/delete/{id}', [
            'as' => 'actors_delete',
            'uses' => 'ActorsController@delete'
        ])->where('id', '[0-9]+');

    });



// CRUD de directors
    Route::group(['prefix' => 'directors'], function () {

        Route::get('/index', [
            'as' => 'directors_delete',
            'uses' => 'DirectorsController@index'
        ]);


        Route::get('/create', [
            'as' => 'directors_create',
            'uses' => 'DirectorsController@create'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'directors_edit',
            'uses' => 'DirectorsController@edit'
        ])->where('id', '[0-9]+');

        Route::get('/delete/{id}', [
            'as' => 'directors_delete',
            'uses' => 'DirectorsController@delete'
        ])->where('id', '[0-9]+');

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




