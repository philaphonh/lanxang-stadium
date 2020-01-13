<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        //
        'admin_username' => $faker->userName,
        'admin_first_name' => $faker->firstName,
        'admin_last_name' => $faker->lastName,
        'admin_password' => $faker->password
    ];
});
