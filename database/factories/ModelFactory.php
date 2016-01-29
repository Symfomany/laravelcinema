<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Http\Models\User::class, function (Faker\Generator $faker) {
    return [
        'email' => "zuzu38080@gmail.com",
        'password' => bcrypt("admin"),
        'salt' => str_random(10),
    ];
});

/**
 * Factory to generate Data Fixtures with Movies & Faker.
 */
$factory->define(\App\Http\Models\Movies::class, function (Faker\Generator $faker) {
    return [
        'type'          => $faker->realText,
        'note_presse'   => $faker->randomDigit,
        'title'         => $faker->title,
        'categories_id' => 1,
        'languages'     => 'fr',
        'distributeur'  => 'HBO',
        'annee'         => $faker->randomDigit,
        'budget'        => $faker->randomDigitNotNull,
        'duree'         => $faker->randomDigitNotNull,
        'synopsis'      => $faker->paragraph(2),
        'description'   => $faker->paragraph,
        'created_at'    => $faker->dateTimeBetween('-1 year', 'now'),
        'date_release'  => $faker->dateTimeBetween('-30 year', 'now'),
        'image'         => $faker->imageUrl(),
    ];
});
