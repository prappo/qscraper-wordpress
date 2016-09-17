<?php
namespace MyPlugin\Controllers;

use Herbert\Framework\Models\Post;
use Illuminate\Database\Capsule\Manager as Capsule;
use MyPlugin\Models\Data;

class HomeController
{
    public function index()
    {
//        $user = get_role('quser');
//        $user->add_cap('qscraper');
//
//        $result = add_role(
//            'quser',
//            __('Qscraper User'),
//            array(
//                'read' => true,  // true allows this capability
//                'qscraper' => true
//            )
//        );
//        if (null !== $result) {
//            echo 'Yay! New role created!';
//        } else {
//            echo 'Oh... the basic_contributor role already exists.';
//        }
//
        $tdata = Data::where('user',wp_get_current_user()->user_login)->count();
        echo $tdata;

    }


}