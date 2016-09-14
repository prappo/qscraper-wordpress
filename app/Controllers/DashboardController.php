<?php
namespace MyPlugin\Controllers;
class DashboardController{
	public function index(){
		return view('@MyPlugin/dashboard.twig');
	}
}