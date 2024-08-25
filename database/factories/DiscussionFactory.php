<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Discussion;
use Faker\Generator as Faker;

$factory->define(Discussion::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'body'  => $faker->text(400),
        'user_id' => '1',
        'cat_id'  => '4',
    ];
});
