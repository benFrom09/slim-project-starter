<?php
namespace Framework\Database;

use Illuminate\Database\Capsule\Manager as Capsule;


class Database
{
    public function __construct() {

        $db = new Capsule();
        
        $db->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}