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
            //$nombre,$apellido,$alia,$dni,$cuil,$email,$emailAlt,$telefono,$telefonoAlt,$contacto,$domicilio,$domicilioFact,$montoPactado,$fichaFisicaIngreso
        $padrinoConsulta = new PadrinoEntity($padrino->nombre, $padrino->apellido,
                                     null,$padrino->dni,
                                     null, null,null, null,null, null,
                                    null, null,null,null);

        if(count($daoPadrino->select($padrinoConsulta))>0){
            return -1;
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

        if($insertDatos){

           $resPadrino=$daoPadrino->insert($padrino);

            if($resPadrino=="OK"){
                    return 0;
                }else{
                    echo $resPadrino;
                    return 1;
                }
        }else{
            return 1;
        }

     }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }
  public function buscarPadrinosLibres($padrino){
       $daoPadrino= new model\dao\DaoPadrinoImpl();
      if($padrino==null){

        $padrinoConsulta = new PadrinoEntity(null, null,
                                     null,null,null, null,null, null,
                                     null, null,
                                    null, null,null,null);
      }else{
        $padrinoConsulta = new PadrinoEntity($padrino->nombre, $padrino->apellido,
                                     null,$padrino->dni,
                                     null, null,null, null,null, null,
                                    null, null,null,null);
      }
      $resultado=$daoPadrino->buscarPadrinosLibres($padrinoConsulta);
      
      return $resultado;
  }
  public function buscarDomFactPorPadrino($padrino){

  }
  public function listarPadrinoLibrePadrinoOcupado(){
      $daoPadrino= new model\dao\DaoPadrinoImpl();
      $resultado=$daoPadrino->listarPadrinoLibrePadrinoOcupado();

      return $resultado;
  }
public function buscarPadrinosVinculados(){
     $daoPadrino= new model\dao\DaoPadrinoImpl();
      $resultado=$daoPadrino->buscarPadrinosVinculados();

    return $resultado;
}
public function buscarHistoricoPadrinosVinculados(){
     $daoPadrino= new model\dao\DaoPadrinoImpl();
      $resultado=$daoPadrino->buscarHistoricoPadrinosVinculados();

    return $resultado;
}
public function listarPadrinos(){
      $daoPadrino= new model\dao\DaoPadrinoImpl();
      $resultado=$daoPadrino->select(null);
        
     return $resultado;
}
public function listarDomicilioPadrino($idDomicilio){
    $daoDomicilio= new model\dao\DaoDomicilioImpl();
    return $daoDomicilio->selectDomicilio($idDomicilio);
}
    public function modificarPadrino($datos){
        $daoPadrino= new model\dao\DaoPadrinoImpl();
        //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$emailAlt,$telefono,$telefonoAlt,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja,$montoPactado,$fichaFisicaIngreso
        $padrino = new PadrinoEntity($datos[0],$datos[2],$datos[3],$datos[1],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],null,null,null,null,null,$datos[11]);
    return $daoPadrino->update($padrino);
    }
public function modificarDomicilioPadrino($domicilio){
     $daoDomicilio= new model\dao\DaoDomicilioImpl();
        
    return $daoDomicilio->update($domicilio);
}
    /**
     * Generar error al intentar clonar el obj de la clase
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaci�nn de este objeto no est� permitida', E_USER_ERROR);

    }

}
?>
