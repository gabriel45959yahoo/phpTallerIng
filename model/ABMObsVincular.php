<?php
include '../model/dao/DaoObsVincularImpl.php';

class ABMObsVincular{
     private static $instanciaObsVincular;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_ObsVincular()
    {

        if (!isset(self::$instanciaObsVincular)) {

            $miclaseObsVincular = __CLASS__;
            self::$instanciaObsVincular = new $miclaseObsVincular;

        }

        return self::$instanciaObsVincular;

    }

    public function cargarObs($obsVincular){

    try{
        $daoAlumno= new model\dao\DaoObsVincularImpl();

        $resAlumno=$daoAlumno->insert($obsVincular);

            if($resAlumno=="OK"){
                    return 0;
                }else{
                    echo $resAlumno;
                    return 1;
                }
       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }

     public function buscarObs($obsVincular){

    }
}
?>
