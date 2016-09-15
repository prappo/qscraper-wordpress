<?php namespace MyPlugin;

/** @var \Herbert\Framework\Enqueue $enqueue */

$enqueue->admin([
    'as'  => 'Jquery',
    'src' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js',
    'filter' => [ 'panel' => '*' ]
]);
$enqueue->admin([
    'as'  => 'bootstrapCSS',
    'src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'bootstrapJS',
    'src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'StyeCSS',
    'src' => Helper::assetUrl('/css/style.css'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'ScriptJS',
    'src' => Helper::assetUrl('/js/script.js'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'SweetCSS',
    'src' => Helper::assetUrl('/css/sweetalert.css'),
    'filter' => [ 'panel' => '*' ]
]);

$enqueue->admin([
    'as'  => 'SweetJS',
    'src' => Helper::assetUrl('/js/sweetalert.min.js'),
    'filter' => [ 'panel' => '*' ]
]);