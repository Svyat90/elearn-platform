<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \App\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    $file = collect([
        'document/2020-09-30/5f745311ebf64.pdf',
        'document/2020-10-02/5f774290e736e.pdf',
        'document/2020-10-02/5f7745436fe03.pdf',
        'document/2020-10-02/5f7747e62336d.pdf',
    ])->random(1)->first();

    return [
        'type' => $faker->company,
        'number' => $faker->randomDigit,
        'name_ru' => $faker->name,
        'name_ro' => $faker->name,
        'name_en' => $faker->name,
        'name_issuer_ru' => $faker->sentence,
        'name_issuer_ro' => $faker->sentence,
        'name_issuer_en' => $faker->sentence,
        'topic_ru' => $faker->sentence,
        'topic_ro' => $faker->sentence,
        'topic_en' => $faker->sentence,
        'description_ru' => $faker->sentences(10, true),
        'description_ro' => $faker->sentences(10, true),
        'description_en' => $faker->sentences(10, true),
        'image_path' => 'document/2020-09-24/5f6c92957a04f.jpg',
        'file_path' => $file,
        'status' => 'initial',
        'access' => 'public'
    ];
});
