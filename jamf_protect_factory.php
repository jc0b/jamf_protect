<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Jamf_protect_model::class, function (Faker\Generator $faker) {

    return [
        'connection_identifier' => $faker->unique()->regexify('[A-F0-9]{8}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{12}'),
        'connection_state' => 'Connected',
        'install_type' => 'systemExtension',
        'last_check_in' => $faker->dateTimeBetween('-4 months', 'now')->getTimestamp(),
        'last_insights_sync'=> $faker->dateTimeBetween('-4 months', 'now')->getTimestamp(),
        'plan_hash' => $faker->unique()->regexify('[a-f0-9]{32}'),
        'plan_id' => $faker->unique()->regexify('[0-9]{2}'),
        'protect_version' => $faker->randomElement(['3.3.0.607', '3.2.0.557', '3.1.6.469']),
        'protection_status' => $faker->randomElement(['Protected', 'Enrolling', 'Missing Plan']),
        'running_monitors' => 'click, download, execAuth',
        'tenant' => 'munkireport.protect',
    ];
});