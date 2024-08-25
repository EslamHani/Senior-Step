<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'tag_name' 		=> $faker->unique()->word,
        'permission' 	=> 1,
        'meta_keywords' => $faker->sentence, 
        'meta_desc' 	=> $faker->sentence,
    ];
});
