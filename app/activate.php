<?php
use Illuminate\Database\Capsule\Manager as Capsule;


Capsule::schema()->create('qsettings', function ($table) {
    $table->increments('id');
    $table->string('key');
    $table->string('value');
	$table->timestamps();
});

Capsule::schema()->create('qdata', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
    $table->string('user')->nullable();
    $table->timestamps();
});

Capsule::table('qsettings')->insert([
    ['key' => 'fbAppId'],
    ['key' => 'fbAppSec'],
    ['key' => 'fbToken'],
    ['key' => 'twConKey'],
    ['key' => 'twConSec'],
    ['key' => 'twToken'],
    ['key' => 'twTokenSec']
]);

add_role(
    'quser',
    __('Qscraper User'),
    array(
        'read' => true,  // true allows this capability
        'qscraper' => true
    )
);