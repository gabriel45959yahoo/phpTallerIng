<?php
namespace model;
//include '../model/dao/DaoDomicilioImpl.php';
//include '../model/ABMPadrino.php';

class ABMDatosFactura{

    private static $instanciaDatosFactura;

    public static function singleton_DatosFactura()
    {

        if (!isset(self::$instanciaDatosFactura)) {

            $miclaseDatosFactura = __CLASS__;
            self::$instanciaDatosFactura = new $miclaseDatosFactura;

        }

        return self::$instanciaDatosFactura;

    }

    public function cargarDatosFactura($padrino)
    {
        $daoDomicilio= new dao\DaoDomicilioImpl();

        $retDoc=$daoDomicilio->insert($padrino->domicilioFact->domicilio);

        if($retDoc=="OK") {

            $doc=$daoDomicilio->select($padrino->domicilioFact->domicilio);

            if(count($doc)>=0){
                $padrino->domicilioFact->domicilio=$doc[0];
            }
            $daoPadrino= new dao\DaoPadrinoImpl();

            $restPadrino=$daoPadrino->select($padrino);

            $padrino->domicilioFact->setIdPadrino($restPadrino[0]->id);

            $datosFactura= new dao\DaoDatosFactImpl();

            $res=$datosFactura->insert($padrino->domicilioFact);

            if($res=="OK"){
                return 0;
            }else{
                echo $res;
                return 1;
            }
        }
    }
    public function buscarDomFactPorPadrino($idPadrino){

      $datosFactura= new dao\DaoDatosFactImpl();

      $resultado=$datosFactura->buscarDomFactPorPadrino($idPadrino);

      return $resultado;
    }

    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }



}
?>
