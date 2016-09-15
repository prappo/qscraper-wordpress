<?php
namespace MyPlugin\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
class SettingsController{
    public static function get($string)
    {
        $data = Capsule::table('qsettings')->where('key',$string)->value('value');
        return $data;
    }

    public function index(){
        return view('@MyPlugin/settings.twig');
    }
}