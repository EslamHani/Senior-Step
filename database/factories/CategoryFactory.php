<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->word,
		'image'         => 'uploads/images/1/lYTDTN6L2n51ksHXpJ8eTpXwRcIVE7385G4Az2hM.jpeg',
		'permission'    => 1,
		'meta_keywords' => $faker->word,
		'meta_desc'     => $faker->sentence,
    ];
});
