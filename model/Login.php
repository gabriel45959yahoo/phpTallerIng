<?php
use model\dao\DaoUsuarioImpl;
use model\entities\UsuarioEntity;

include '../model/dao/DaoUsuarioImpl.php';
include '../model/entities/UsuarioEntity.php';
include '../model/entities/RolEntity.php';

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

    public function rol_users($usuario) {
        $daoUsuario = new DaoUsuarioImpl();
        $usr = new UsuarioEntity();
        $usr->setUsuario($usuario);

        return json_encode($daoUsuario->select($usr));
    }
    public function listarUsuarios(){
        $daoUsuario = new DaoUsuarioImpl();

        return $daoUsuario->select(null);
    }
    public function listarRol(){
        $daoUsuario = new DaoUsuarioImpl();

        return $daoUsuario->selectRol();
    }
    public function modificarUsuario($datos){
         $daoUsuario = new DaoUsuarioImpl();

        if($daoUsuario->update($datos)){
            return "Los datos se modificaron correctamente";
        }
     return "Error al modificar los datos del usuario";
    }
    public function cargarUsuario($usuario){
       $daoUsuario = new DaoUsuarioImpl();

       $res=$daoUsuario->insert($usuario);

            if($res=="OK"){
                    return 0;
                }else{
                    echo $res;
                    return 1;
                }
    }
    public function __clone() {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

}
