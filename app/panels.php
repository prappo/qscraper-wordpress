<?php namespace MyPlugin;


/** @Dashboard */
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
    'type' => 'panel',
    'as' => 'qscraperadmin',
    'title' => 'Qscraper',
    'slug' => 'qscrapera',
    'icon' => 'dashicons-search',
    'capability' => 'administrator',
    'uses' => __NAMESPACE__ . '\Controllers\DashboardController@index'
]);


/** @Facebook Scraper */

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'facebooka',
    'title' => 'Facebook Scraper',
    'capability' => 'administrator',
    'slug' => 'fbscraper',
    'uses' => __NAMESPACE__ . '\Controllers\FacebookController@index'
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

/** @Twitter Scraper*/

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'twitter',
    'title' => 'Twitter Scraper',
    'slug' => 'twscrapera',
    'capability' => 'administrator',
    'uses' => __NAMESPACE__ . '\Controllers\TwitterController@index'
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
/**@Database */

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'database',
    'title' => 'Database',
    'capability' => 'administrator',
    'slug' => 'qscraperdatabaseaa',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@index'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'database',
    'title' => 'Database',
    'capability' => 'quser',
    'slug' => 'qscraperdatabase',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@index'
]);

/** phone numbers*/
$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'phone',
    'title' => 'Phone Numbers',
    'capability' => 'administrator',
    'slug' => 'qscraperphonea',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@phone'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'phone',
    'title' => 'Phone Numbers',
    'capability' => 'quser',
    'slug' => 'qscraperphone',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@phone'
]);

/**@Emails*/

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'email',
    'title' => 'Emails',
    'capability' => 'administrator',
    'slug' => 'qscraperemaila',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@email'
]);

$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraper',
    'as' => 'email',
    'title' => 'Emails',
    'capability' => 'quser',
    'slug' => 'qscraperemail',
    'uses' => __NAMESPACE__ . '\Controllers\DatabaseController@email'
]);

/** @Settings */
$panel->add([
    'type' => 'sub-panel',
    'parent' => 'qscraperadmin',
    'as' => 'Settings',
    'title' => 'Settings',
    'slug' => 'qscrapersettings',
    'uses' => __NAMESPACE__ . '\Controllers\SettingsController@index'
]);
