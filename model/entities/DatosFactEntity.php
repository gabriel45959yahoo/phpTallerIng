<?php
namespace model\entities;

class DatosFactEntity{

    var $id;
    var $nombre;
    var $apellido;
    var $dni;
    var $email;
    var $cuil;
    var $telefono;
    var $domicilio;
    var $fechaAlta;
    var $fechaBaja;


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



function __construct8($id,$nombre,$apellido,$dni,$email,$cuil,$telefono,$domicilio){

    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->dni=$dni;
    $this->email=$email;
    $this->cuil=$cuil;
    $this->telefono=$telefono;
    $this->domicilio=$domicilio;
}
function __construct10($id,$nombre,$apellido,$dni,$email,$cuil,$telefono,$domicilio,$fechaAlta,$fecjaBaja){

    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->dni=$dni;
    $this->email=$email;
    $this->cuil=$cuil;
    $this->telefono=$telefono;
    $this->domicilio=$domicilio;
    $this->fechaAlta=$fechaAlta;
    $this->fechaBaja=$fecjaBaja;
}
}
?>
