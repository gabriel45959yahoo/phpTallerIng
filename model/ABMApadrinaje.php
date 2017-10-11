<?php
include '../model/dao/DaoApadrinajeImpl.php';
use model\entities\ApadrinajeEntity as ApadrinajeEntity;

class ABMApadrinaje{


      private static $instanciaApadrinaje;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_Apadrinaje()
    {

        if (!isset(self::$instanciaApadrinaje)) {

            $miclaseApadrinaje = __CLASS__;
            self::$instanciaApadrinaje = new $miclaseApadrinaje;

        }

        return self::$instanciaApadrinaje;

    }


    function asociar($apadrinaje){
      try{
        $daoApadrinaje= new model\dao\DaoApadrinajeImpl();

        $res=$daoApadrinaje->insert($apadrinaje);

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
    function anularAsocicion(){


    }
    function buscarAsociacion(){

    }
    function historialPadrino(){

    }
    function listarPadrinoAhijado(){
      try{
        $daoApadrinaje= new model\dao\DaoApadrinajeImpl();

        return $daoApadrinaje->listaPadrinoAhijado();


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
