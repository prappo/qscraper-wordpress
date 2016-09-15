<?php
namespace MyPlugin\Controllers;
class TwitterController{
    public function index(){
        return view('@MyPlugin/twitter.twig');
    }
}