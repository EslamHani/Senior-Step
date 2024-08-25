<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Skill;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'skill_name' 	=> $faker->unique()->word,
        'permission' 	=> 1,
        'meta_keywords' => $faker->sentence, 
        'meta_desc' 	=> $faker->sentence,
    ];
});
