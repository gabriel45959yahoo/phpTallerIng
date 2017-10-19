<?php
namespace model;
include '../model/dao/DaoPlanPactadoImpl.php';

use model\entities\PlanPactadoEntity as PlanPactadoEntity;
class ABMPlanPactado{

    private static $instanciaPlanPactado;

     public static function singleton_PlanPactado()
    {

        if (!isset(self::$instanciaPlanPactado)) {

            $miclasePlanPactado = __CLASS__;
            self::$instanciaPlanPactado = new $miclasePlanPactado;

        }

        return self::$instanciaPlanPactado;

    }



    /**
     * Se inserta el plan desde el padrino
     * @param  [[Type]] $padrino [[Description]]
     * @return [[Type]] [[Description]]
     */
    function cargar($padrino){

        $daoPadrino= new dao\DaoPadrinoImpl();
        $restPadrino=$daoPadrino->select($padrino);
        $padrino->setId($restPadrino[0]->id);

        $daoplanPactado = new dao\DaoPlanPactadoImpl();
        //$id,$idPadrino,$montoTotal,$yearLectivo
        $res=$daoplanPactado->insert(new PlanPactadoEntity(0,$padrino->getId(),$padrino->getMontoPactado(),0));

       if($res=="OK"){
            return 0;
        }else{
            echo $res;
            return 1;
        }

    }

    function listarPlanes(){
        $daoplanPactado = new dao\DaoPlanPactadoImpl();

        return  $daoplanPactado->select(null);

    }

    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }
}
?>
