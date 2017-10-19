<?php
include '../model/dao/DaoPagoRealizado.php';
include '../model/dao/DaoDetallePago.php';

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

        return $daoPago->listTipoPago(null);


       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
 }

public function cargarPago($detallePago,$pagoRealizado){
      try{
        $daoDetallePago= new model\dao\DaoDetallePago();
        $daoPago= new model\dao\DaoPagoRealizado();

        $rest = $daoDetallePago->insert($detallePago);

        if($rest=="OK"){
           $pagoRealizado->idDetallePago= $daoDetallePago->select($detallePago)[0]->id;
        }else{
            return $rest;
        }


        return $daoPago->insert($pagoRealizado);


       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
 }



}

?>
