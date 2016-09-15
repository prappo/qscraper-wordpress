<?php namespace MyPlugin;

/** @var \Herbert\Framework\Panel $panel */
$panel->add([
    'type' => 'panel',
    'as' => 'qscraper',
    'title' => 'Qscraper',
    'slug' => 'qscraper',
    'icon' => 'dashicons-search',
    'capability' => 'quser',
    'uses' => __NAMESPACE__ . '\Controllers\DashboardController@index'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'facebook',
    'title' => 'Facebook Scraper',
    'capability' => 'quser',
    'slug' => 'fbscraper',
    'uses' => __NAMESPACE__ . '\Controllers\FacebookController@index'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'twitter',
    'title' => 'Twitter Scraper',
    'slug' => 'twscraper',
    'capability' => 'quser',
    'uses' => __NAMESPACE__ . '\Controllers\TwitterController@index'
]);
$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'database',
    'title' => 'Database',
    'capability' => 'quser',
    'slug' => 'qscraperdatabase',
    'uses' => __NAMESPACE__ . '\Controllers\TwitterController@index'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'Settings',
    'title' => 'Settings',
    'slug' => 'qscrapersettings',
    'uses' => __NAMESPACE__ . '\Controllers\SettingsController@index'
]);
