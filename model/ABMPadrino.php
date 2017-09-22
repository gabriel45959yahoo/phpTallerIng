<?php
include '../model/dao/DaoPadrinoImpl.php';
class ABMPadrino{
    
    private static $instanciaPadrino;

    public static function singleton_Padrino()
    {

        if (!isset(self::$instanciaPadrino)) {

            $miclasePadrino = __CLASS__;
            self::$instanciaPadrino = new $miclasePadrino;

        }

        return self::$instanciaPadrino;

    }
    /**
     * login del usuario
     * @param  [[Type]] $usuario [[Description]]
     * @param  [[Type]] $clave   [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function cargarPadrino($padrino)
    {
        $daoPadrino= new DaoPadrinoImpl();
        
        $resultado=$daoPadrino->insertPadrino($padrino);

        if($resultado=="OK"){
            return true;
        }else{
            echo $resultado;
            return false;
        }
    }
    public function Padrino getPadrino($padrino){
        
    }

    /**
     * [[Description]]
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaci�nn de este objeto no est� permitida', E_USER_ERROR);

    }

}
?>
