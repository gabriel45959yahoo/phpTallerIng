<?php
namespace model;

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

            $datosFactura= new dao\DaoDatosFactImpl();

            $res=$datosFactura->insert($padrino->domicilioFact);

            if($res=="OK"){
                return true;
            }else{
                return false;
            }
        }
    }


    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }



}
?>
