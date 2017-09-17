<?php
include '../model/dao/DaoPadrinoImpl.php';
class ABMPadrino{
    private static $instancia;

    public static function singleton_Padrino()
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
    public function cargarPadrino($padrino)
    {

        $padrino = new DaoPadrinoImpl();
        $resultado=$padrino->insertPadrino($padrino);
        if($resultado=="OK"){
            return true;
        }else{
            echo $resultado;
            return false;
        }
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
?>
