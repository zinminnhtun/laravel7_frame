<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    $arr = ["Vue", "React", "Node Js", "Express Js", "Laravel", "Inertia", "Php", "Firebase", "Tailwind Css","React Native"];
    return [
        "title" => $arr[array_rand($arr,1)],
        "user_id" => \App\User::all()->random()->id,
    ];
});
