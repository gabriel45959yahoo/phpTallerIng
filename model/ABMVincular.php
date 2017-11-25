<?php
include '../model/dao/DaoVincularImpl.php';
use model\entities\VincularEntity as VincularEntity;

class ABMVincular{


      private static $instanciaVincular;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_Vincular()
    {

        if (!isset(self::$instanciaVincular)) {

            $miclaseVincular = __CLASS__;
            self::$instanciaVincular = new $miclaseVincular;

        }

        return self::$instanciaVincular;

    }


    function asociar($vincular){
      try{
        $daoVincular= new model\dao\DaoVincularImpl();

        $res=$daoVincular->insert($vincular);

        if($res=="OK"){
                return 0;
            }else{
                echo $res;
                return 1;
            }
       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }
    function anularVinculacion($idVinculacion){
      try{
        $daoVincular= new model\dao\DaoVincularImpl();

        $res=$daoVincular->desvincular($idVinculacion);

        if($res=="OK"){
                return 0;
            }else{
                echo $res;
                return 1;
            }
       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }

    }
    function buscarAsociacion($obj){
     try{
        $daoVincular= new model\dao\DaoVincularImpl();

        return $daoVincular->select($obj);


       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }
 
    function listarPadrinoAhijado(){
      try{
        $daoVincular= new model\dao\DaoVincularImpl();

        return $daoVincular->listaPadrinoAhijado();


       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }
    public function buscarAhijadosdelPadrino($idPadrino){
      try{
        $daoVincular= new model\dao\DaoVincularImpl();

        return $daoVincular->buscarAhijadosdelPadrino($idPadrino);


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
