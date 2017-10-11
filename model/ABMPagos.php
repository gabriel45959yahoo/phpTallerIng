<?php
include '../model/dao/DaoPagoRealizado.php';

class ABMPagos{

   private static $instanciaPagos;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_Pagos()
    {

        if (!isset(self::$instanciaPagos)) {

            $miclasePagos = __CLASS__;
            self::$instanciaPagos = new $miclasePagos;

        }

        return self::$instanciaPagos;

    }

   /**
     * Generar error al intentar clonar el obj de la clase
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }
 public function listarTipoPago(){
      try{
        $daoPago= new model\dao\DaoPagoRealizado();

        return $daoPago->select(null);


       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
 }
}

?>
