<?php namespace MyPlugin;

/** @var \Herbert\Framework\Router $router */
$router->get(['uri'=>'facebook','uses'=>__NAMESPACE__.'\Controllers\HomeController@index']);
$router->post(['uri'=>'qscraperf','uses'=>__NAMESPACE__.'\Controllers\FacebookController@scraper']);
$router->post(['uri'=>'qsupdate','uses'=>__NAMESPACE__.'\Controllers\SettingsController@update']);
$router->get(['uri'=>'qscraper/fbconnect','uses'=>__NAMESPACE__.'\Controllers\SettingsController@fbConnect']);