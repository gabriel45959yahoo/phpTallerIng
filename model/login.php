<?php
include '../model/dao/DaoUsuarioImpl.php';
include '../model/entities/UsuarioEntity.php';


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
    /**
     * login del usuario
     * @param  [[Type]] $usuario [[Description]]
     * @param  [[Type]] $clave   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function login_users($usuario,$clave)
    {
        $daoUsuario= new DaoUsuarioImpl();
        $usr=new UsuarioEntity();
        $usr->setUsuario($usuario);
        $usr->setClave($clave);
        return $daoUsuario->esUsuario($usr);
    }


    /**
     * [[Description]]
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }

}
