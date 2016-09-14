<?php
namespace MyPlugin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
class Data extends Eloquent{
    protected $fillable = ['name','phone','email'];
    protected $table = "qdata";
}