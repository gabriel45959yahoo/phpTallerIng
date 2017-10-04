<?php
namespace model\entities;

class DatosFactEntity extends Persona{

    var $id;
    var $cuil;
    var $domicilio;
    var $fechaAlta;
    var $idPadrino;


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

function __construct6($id,$nombre,$apellido,$dni,$cuil,$domicilio){
    parent::__construct($nombre,$apellido,$dni);
    $this->id=$id;
    $this->cuil=$cuil;
    $this->domicilio=$domicilio;
}
function __construct8($id,$nombre,$apellido,$dni,$cuil,$domicilio,$fechaAlta,$idPadrino){
    parent::__construct($nombre,$apellido,$dni);
    $this->id=$id;
    $this->cuil=$cuil;
    $this->domicilio=$domicilio;
    $this->fechaAlta=$fechaAlta;
}
     public function  getId(){
        return $this->id;
    }
    public function  getCuil(){
        return $this->cuil;
    }
       public function getFechaBaja(){
        return $this->fechaBaja;
    }
     public function  getDomicilio(){
        return $this->domicilio;
    }
     public function  getIdPadrino(){
        return $this->idPadrino;
    }
     public function  setIdPadrino($idPadrino){
        $this->idPadrino=$idPadrino;
    }
     public function  setDomicilio($domicilio){
        $this->domicilio=$domicilio;
    }
    public function  setFechaAlta($fechaAlta){
        $this->fechaAlta=$fechaAlta;
    }
     public function  setId($id){
        $this->id=$id;
    }
}
?>
