<?php


use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('qsettings');
Capsule::schema()->dropIfExists('qdata');
remove_role('quser');