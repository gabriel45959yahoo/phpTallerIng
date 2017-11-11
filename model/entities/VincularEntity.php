<?php
namespace model\entities;

class VincularEntity{
    var $id;
    var $idPadrino;
    var $idAlumno;
    var $seConocen;
    var $observaciones;
    var $fechaAlta;
    var $fechaBaja;
    var $estadoPlanPactado;

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

function __construct4($idPadrino,$idAlumno,$seConocen,$observaciones){

    $this->idPadrino=$idPadrino;
    $this->observaciones=$observaciones;
    $this->idAlumno=$idAlumno;
    $this->seConocen=$seConocen;


}

function __construct7($id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja){
    $this->id=$id;
    $this->idPadrino=$idPadrino;
    $this->observaciones=$observaciones;
    $this->idAlumno=$idAlumno;
    $this->seConocen=$seConocen;
    $this->fechaAlta=$fechaAlta;
    $this->fechaBaja=$fechaBaja;
}
 public function  getId(){
        return $this->id;
    }
 public function  setId($id){
        $this->id=$id;
    }
 public function  getIdAlumno(){
        return $this->idAluno;
    }
 public function  setIdAlumno($idAlumno){
        $this->id=$idAlumno;
    }
 public function  getIdPadrino(){
        return $this->idPadrino;
    }
 public function  setIdPadrino($idPadrino){
        $this->id=$idPadrino;
    }
 public function  getSeConocen(){
        return $this->seConocen;
    }
 public function  setSeConocen($seConocen){
        $this->id=$seConocen;
    }
 public function  getObservaciones(){
        return $this->observaciones;
    }
 public function  setObservaciones($observaciones){
        $this->id=$observaciones;
    }
 public function  getFechaAlta(){
        return $this->fchaAlta;
    }
 public function  setFechaAlta($fechaAlta){
        $this->id=$fechaAlta;
    }
public function  getFechaBaja(){
        return $this->fchaBaja;
    }
 public function  setFechaBaja($fechaBaja){
        $this->id=$fechaBaja;
    }
 public function  getEstadoPlanPactado(){
        return $this->estadoPlanPactado;
    }
 public function  setEstadoPlanPactado($estadoPlanPactado){
        $this->estadoPlanPactado=$estadoPlanPactado;
    }
}
?>
