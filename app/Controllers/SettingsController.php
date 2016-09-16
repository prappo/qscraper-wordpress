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
        $fbAppId = SettingsController::get('fbAppId');
        $fbAppSec = SettingsController::get('fbAppSec');

        $twConKey = SettingsController::get('twConKey');
        $twConSec = SettingsController::get('twConSec');
        $twToken = SettingsController::get('twToken');
        $twTokenSec = SettingsController::get('twTokenSec');
        return view('@MyPlugin/settings.twig',['fbAppId'=>$fbAppId,'fbAppSec'=>$fbAppSec,'twConKey'=>$twConKey,'twConSec'=>$twConSec,'twToken'=>$twToken,'twTokenSec'=>$twTokenSec]);
    }
}