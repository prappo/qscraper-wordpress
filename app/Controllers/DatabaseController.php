<?php
namespace MyPlugin\Controllers;
class DatabaseController{
    public function index(){
        return view('@MyPlugin/database.twig');
    }
}