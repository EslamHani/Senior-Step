<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DiscussionReply;
use Faker\Generator as Faker;

$factory->define(DiscussionReply::class, function (Faker $faker) {
    return [
        'discussion_reply' => $faker->text(200),
        'user_id' => '5',
        'discussion_id' => '28',
    ];
});
