<?php
namespace model\entities;

class AlumnoEntity extends Persona{
    var $id;
    var $cuil;
    var $email;
    var $telefono;
    var $contacto;
    var $alia;
    var $domicilio;
    var $domicilioFact;

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
function __construct11($id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact){
    parent::__construct($nombre,$apellido,$dni);
    $this->id=$id;
    $this->cuil=$cuil;
    $this->email=$email;
    $this->telefono=$telefono;
    $this->contacto=$contacto;
    $this->alia=$alia;
    $this->domicilio=$domicilio;
    $this->domicilioFact=$domicilioFact;
}
function __construct10($nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact){
    parent::__construct($nombre,$apellido,$dni);
    $this->cuil=$cuil;
    $this->email=$email;
    $this->telefono=$telefono;
    $this->contacto=$contacto;
    $this->alia=$alia;
    $this->domicilio=$domicilio;
    $this->domicilioFact=$domicilioFact;
}
  public function  getAlia(){
        return $this->alia;
    }
    public function  getCuil(){
        return $this->cuil;
    }
     public function  getEmail(){
        return $this->email;
    }
     public function  getTelefono(){
        return $this->telefono;
    }
     public function  getContacto(){
        return $this->contacto;
    }
     public function  getDomicilio(){
        return $this->domicilio;
    }
     public function  getDomicilioFact(){
        return $this->domicilioFact;
    }
     public function  getId(){
        return $this->id;
    }
     public function  setId($id){
        $this->id=$id;
    }
     public function  setDomicilioFact($domicilioFact){
        $this->domicilioFact=$domicilioFact;
    }
     public function  setDomicilio($domicilio){
        $this->domicilio=$domicilio;
    }
     public function  setContacto($contacto){
        $this->telefono=$contacto;
    }
     public function  setTelefono($telefono){
        $this->telefono=$telefono;
    }
     public function  setEmail($email){
        $this->email=$email;
    }
     public function  setAlia($alia){
        $this->alia=$alia;
    }
    public function  setCuil($cuil){
        $this->cuil=$cuil;
    }


}



}
?>
