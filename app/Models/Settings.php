<?php
namespace MyPlugin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
class Settings extends Eloquent{
	protected $fillable = ['key','value'];
	protected $table = "qsettings";
}