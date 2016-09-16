<?php
namespace MyPlugin\Controllers;
use MyPlugin\Models\Data;

class DatabaseController{
    public function index(){
        $datas = Data::all();
        return view('@MyPlugin/database.twig',['datas'=>$datas]);
    }
}