<?php

use model\dao\DaoUsuarioImpl;
use model\entities\UsuarioEntity;

include '../model/dao/DaoUsuarioImpl.php';
include '../model/entities/UsuarioEntity.php';

class Login {

    private static $instancia;

    public static function singleton_login() {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }

        return self::$instancia;
    }

    public function login_users($usuario, $clave) {
        $daoUsuario = new DaoUsuarioImpl();
        $usr = new UsuarioEntity();
        $usr->setUsuario($usuario);
        $usr->setClave($clave);
        return $daoUsuario->esUsuario($usr);
    }

    public function __clone() {

        trigger_error('La clonaci�n de este objeto no est� permitida', E_USER_ERROR);
    }

}
