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

    public function cargarDatosFactura($datosFactura)
    {

    }


    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }



}
?>
