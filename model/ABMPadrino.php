<?php
include '../model/dao/DaoPadrinoImpl.php';
include '../model/dao/DaoDomicilioImpl.php';
include '../model/dao/DaoDatosFactImpl.php';
use model\entities\PadrinoEntity as PadrinoEntity;
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
        try{
        $daoPadrino= new model\dao\DaoPadrinoImpl();
        $padrinoConsulta = new PadrinoEntity($padrino->nombre, $padrino->apellido,
                                     null,$padrino->dni,
                                     null, null,
                                    null, null,null,null);

        if(count($daoPadrino->select($padrinoConsulta))>0){
            return null;
        }

        $insertDatos = false;
        $daoDomicilio= new model\dao\DaoDomicilioImpl();
        
        $retDoc=$daoDomicilio->insert($padrino->getDomicilio());

        if($retDoc=="OK") {

            $doc=$daoDomicilio->select($padrino->getDomicilio());

            if(count($doc)>0){
                $padrino->domicilio=$doc[0];
            }
            $insertDatos=true;
        }else{
           $insertDatos=false;
        }


        if(!$padrino->domicilioFact->nombre==null) {
            $daoDatoFact= new model\dao\DaoDatosFactImpl();
            $redatoFact=$daoDatoFact->select($padrino->getDomicilioFact());

            if(count($redatoFact)>0){
                $padrino->domicilioFact=$redatoFact[0];

            }
        }

        if($insertDatos){

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

     }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
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
