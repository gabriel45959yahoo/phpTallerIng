<?php

session_start();

class Login
{
    private static $instancia;
    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }
    public function login_users($nick,$password)
    {

        if($nick == "gaby"){
            $_SESSION['username'] = $nick;
            return TRUE;
        }
        print "Error!: " ;
        return false;
    }


    // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}
