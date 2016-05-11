<?php

class Conf {

    private static $database = array(
        'hostname' => 'localhost',  
        'database' => 'attente', 
        'login' => 'lui',
        'password' => 'lui'
    );
    
    private static $seed = 'fdhg998jhj3ehdfjh';
    
    static public function getSeed () {
          return self :: $seed ;
    }
    
    private static $debug = true;

    static public function getLogin() {
        return self::$database['login'];
    }

    static public function getHostname() {
        return self::$database['hostname'];
    }

    static public function getDatabase() {
        return self::$database['database'];
    }

    static public function getPassword() {
        return self::$database['password'];
    }
    
    static public function getDebug() {
        return self::$debug;
    }
    
    

}

?>
