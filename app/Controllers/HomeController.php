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
        foreach(get_users() as $users){
            print_r($users->roles[0]);
        }


    }


}