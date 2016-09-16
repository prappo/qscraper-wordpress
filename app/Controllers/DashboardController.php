<?php
namespace MyPlugin\Controllers;
use MyPlugin\Models\Data;

class DashboardController
{
    public function index()
    {
        if (wp_get_current_user()->roles[0] == "administrator" || wp_get_current_user()->roles[0] == "quser") {
            $tdata = Data::all()->count();
            $mailCount = 0;
            $phoneCount = 0;
            $userCount = 0;
            foreach(get_users() as $users){
                if($users->roles[0] == "quser"){
                    $userCount++;
                }
            }
            foreach (Data::all() as $data){
                if($data->email == ""){
                    $mailCount++;
                }
            }
            foreach (Data::all() as $d){
                if($d->phone == ""){
                    $phoneCount++;
                }
            }
            $temail = Data::all()->count() - $mailCount;
            $tphone = Data::all()->count() - $phoneCount;
            return view('@MyPlugin/dashboard.twig',['tdata'=>$tdata,'temail'=>$temail,'tphone'=>$tphone,'usercount'=>$userCount]);
        }
        else{
            return "Your account is not activated . Please contact to admin";
        }



    }
}