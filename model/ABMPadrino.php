<?php
include '../model/dao/DaoPadrinoImpl.php';
include '../model/dao/DaoDomicilioImpl.php';
include '../model/dao/DaoDatosFactImpl.php';
class ABMPadrino{
    
    private static $instanciaPadrino;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_Padrino()
    {

        if (!isset(self::$instanciaPadrino)) {

            $miclasePadrino = __CLASS__;
            self::$instanciaPadrino = new $miclasePadrino;

        }

        return self::$instanciaPadrino;

    }
    /**
     * Guardo los datos de un padrino y el domicilio
     * @param  [[Type]] $padrino [[Description]]
     * @return boolean  [[Description]]
     */
    public function cargarPadrino($padrino)
    {
        $insertDatos = false;
        $daoDomicilio= new model\dao\DaoDomicilioImpl();
        
        $retDoc=$daoDomicilio->insert($padrino->domicilio);

        if($retDoc=="OK") {

            $doc=$daoDomicilio->select($padrino->domicilio);

            if(count($doc)>0){
                $padrino->domicilio=$doc[0];
            }
            $insertDatos=true;
        }else{
           $insertDatos=false;
        }


        if(!$padrino->domicilioFact->nombre==null) {
            $daoDatoFact= new model\dao\DaoDatosFactImpl();
            $redatoFact=$daoDatoFact->select($padrino->domicilioFact);

            if(count($redatoFact)>0){
                $padrino->domicilioFact=$redatoFact[0];

            }
        }

        if($insertDatos){

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
     * Generar error al intentar clonar el obj de la clase
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }

}
?>
