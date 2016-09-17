<?php
namespace MyPlugin\Controllers;
use MyPlugin\Models\Data;

class DatabaseController{
    /**
     * @return string
     */
    public function index(){
        $url = get_site_url();
        $user = wp_get_current_user()->user_login;
        $role =  wp_get_current_user()->roles[0];
        if($role == "administrator" ){
            $datas = Data::all();
        }
        else{
            $datas = Data::where('user',$user)->get();
        }

        return view('@MyPlugin/database.twig',['datas'=>$datas,'url'=>$url]);
    }

    /**
     * @return string
     */
    public function phone(){
        $user = wp_get_current_user()->user_login;
        $role =  wp_get_current_user()->roles[0];
        if($role == "administrator" ){
            $datas = Data::all();
        }
        else{
            $datas = Data::where('user',$user)->get();
        }

        return view('@MyPlugin/phone.twig',['datas'=>$datas]);
    }

    /**
     * @return string
     */
    public function email(){
        $user = wp_get_current_user()->user_login;
        $role =  wp_get_current_user()->roles[0];
        if($role == "administrator" ){
            $datas = Data::all();
        }
        else{
            $datas = Data::where('user',$user)->get();
        }

        return view('@MyPlugin/email.twig',['datas'=>$datas]);
    }

    /**
     * @return string
     */
    public function delete(){
        $user = wp_get_current_user()->user_login;
        $role =  wp_get_current_user()->roles[0];
        if($role == "administrator"){
            try{
                Data::truncate();
                return "success";
            }
            catch (\Exception $e){
                return $e->getMessage();
            }
        }
        else{
            try{
                Data::where('user',$user)->delete();
                return "success";
            }
            catch (\Exception $e){
                return $e->getMessage();
            }
        }

    }
}