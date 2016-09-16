<?php
namespace MyPlugin\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Herbert\Framework\Http;
use Illuminate\Database\Capsule\Manager as Capsule;
use MyPlugin\Models\Settings;

class SettingsController
{
    public static function get($string)
    {
        $data = Capsule::table('qsettings')->where('key', $string)->value('value');
        return $data;
    }

    public function index()
    {

        session_start();


        $url = get_site_url();
        try {
            $fb = new Facebook([
                'app_id' => self::get('fbAppId'),
                'app_secret' => self::get('fbAppSec'),
                'default_graph_version' => 'v2.6',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl($url . '/qscraper/fbconnect');
        } catch (\Exception $e) {
            $loginUrl = get_admin_url() . "admin.php?page=qscrapersettings";
        }
        $fbAppId = SettingsController::get('fbAppId');
        $fbAppSec = SettingsController::get('fbAppSec');

        $twConKey = SettingsController::get('twConKey');
        $twConSec = SettingsController::get('twConSec');
        $twToken = SettingsController::get('twToken');
        $twTokenSec = SettingsController::get('twTokenSec');
        return view('@MyPlugin/settings.twig', ['fbAppId' => $fbAppId, 'fbAppSec' => $fbAppSec, 'twConKey' => $twConKey, 'twConSec' => $twConSec, 'twToken' => $twToken, 'twTokenSec' => $twTokenSec, 'url' => $url, 'fburl' => $loginUrl]);
    }

    public function update(Http $re)
    {
        try {
            Settings::where('key', 'fbAppId')->update(['value' => $re->fbAppId]);
            Settings::where('key', 'fbAppSec')->update(['value' => $re->fbAppSec]);
            Settings::where('key', 'twConKey')->update(['value' => $re->twConKey]);
            Settings::where('key', 'twConSec')->update(['value' => $re->twConSec]);
            Settings::where('key', 'twToken')->update(['value' => $re->twToken]);
            Settings::where('key', 'twTokenSec')->update(['value' => $re->twTokenSec]);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function fbConnect()
    {
        session_start();
        $fb = new Facebook([
            'app_id' => self::get('fbAppId'),
            'app_secret' => self::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
            $_SESSION['token'] = $accessToken;
            Settings::where('key', 'fbToken')->update(['value' => $accessToken]); // save user access token to database
            $redirectUrl = get_site_url() . "/wp-admin/admin.php?page=qscrapersettings";
            echo "<meta http-equiv=\"refresh\" content=\"0; url={$redirectUrl}/\" />";


        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            return '[a] Graph returned an error: ' . $e->getMessage();

        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            return '[a] Facebook SDK returned an error: ' . $e->getMessage();

        }

    }
}