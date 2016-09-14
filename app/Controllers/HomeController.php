<?php
namespace MyPlugin\Controllers;
class HomeController{
    public function index(){

    print_r(wp_get_current_user());
    }


}