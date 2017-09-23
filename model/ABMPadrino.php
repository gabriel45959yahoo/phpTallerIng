<?php
include '../model/dao/DaoPadrinoImpl.php';
include '../model/dao/DaoDomicilioImpl.php';
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
        $daoDomicilio= new model\dao\DaoDomicilioImpl();
        
        $retDoc=$daoDomicilio->insert($padrino->domicilio);

        if($retDoc=="OK") {

            $doc=$daoDomicilio->select($padrino->domicilio);

            if(count($doc)>=0){
                $padrino->domicilio=$doc[0];
            }
            echo $doc[0]->id;
            $daoPadrino= new model\dao\DaoPadrinoImpl();

            $resPadrino=$daoPadrino->insert($padrino);

            if($resPadrino=="OK"){
                return true;
            }else{
                echo $resPadrino;
                return false;
            }
        }else{
           return false;
        }

        
    }

    /**
     * [[Description]]
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }

}
?>
