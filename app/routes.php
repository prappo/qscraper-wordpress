<?php namespace MyPlugin;

/** @var \Herbert\Framework\Router $router */
$router->get(['uri'=>'facebook','uses'=>__NAMESPACE__.'\Controllers\HomeController@index']);