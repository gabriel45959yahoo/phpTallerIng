<?php
namespace model\entities;

class PlanPactadoEntity{
    var $id;
    var $idPadrino;
    var $montoTotal;
    var $yearLectivo;

    function __construct()
	{
		//obtengo un array con los parámetros enviados a la función
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
	}

 function __construct4($id,$idPadrino,$montoTotalm,$yearLectivo){
     $this->id=$id;
     $this->idPadrino=$idPadrino;
     $this->montoTotal=$montoTotal;
     $this->yearLectivo=$yearLectivo;
 }
  public function  getId(){
        return $this->id;
    }
  public function  setId($id){
        $this->id=$id;
    }
   public function  getIdPadrino(){
        return $this->idPadrino;
    }
  public function  setIdPadrino($idPadrino){
        $this->idPadrino=$idPadrino;
    }
   public function  getYearLectivo(){
        return $this->yearLectivo;
    }
  public function  setYearLectivo($yearLectivo){
        $this->yearLectivo=$yearLectivo;
    }
 public function  getMontoTotalm(){
        return $this->montoTotalm;
    }
  public function  setMontoTotalm($montoTotalm){
        $this->montoTotalm=$montoTotalm;
    }
}

?>
