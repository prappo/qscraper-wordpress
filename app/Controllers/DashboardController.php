<?php
namespace MyPlugin\Controllers;
class DashboardController
{
    public function index()
    {
        if (wp_get_current_user()->roles[0] == "administrator" || wp_get_current_user()->roles[0] == "quser") {
            return view('@MyPlugin/dashboard.twig');
        }
        else{
            return "Your account is not activated . Please contact to admin";
        }


    }
}