<?php

/** @var  \Herbert\Framework\Application $container */
/** @var  \Herbert\Framework\Http $http */
/** @var  \Herbert\Framework\Router $router */
/** @var  \Herbert\Framework\Enqueue $enqueue */
/** @var  \Herbert\Framework\Panel $panel */
/** @var  \Herbert\Framework\Shortcode $shortcode */
/** @var  \Herbert\Framework\Widget $widget */

use Illuminate\Database\Capsule\Manager as Capsule;


Capsule::schema()->create('qsettings', function ($table) {
    $table->increments('id');
    $table->string('key');
    $table->string('value');
});

Capsule::schema()->create('qdata', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
});

Capsule::table('qsettings')->insert([
    ['key' => 'fbAppId'],
    ['key'=>'fbAppSec'],
    ['key'=>'fbToken'],
    ['key'=>'twConKey'],
    ['key'=>'twConSec'],
    ['key'=>'twToken'],
    ['key'=>'twTokenSec']
]);