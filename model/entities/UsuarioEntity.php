<?php
namespace model\entities;
include '../model/entities/Persona.php';
class UsuarioEntity extends Persona{
    var $usuario;
    var $clave;
    var $rol;
    var $email;

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
function __construct6($nombre,$apellido,$usuario,$clave,$rol,$email){
    parent::__construct($nombre,$apellido,0);
    $this->usuario=$usuario;
    $this->clave=$clave;
    $this->rol=$rol;
    $this->email=$email;

}


function setUsuario($usuario){
    $this->usuario=$usuario;
}
function setClave($clave){
    $this->clave=$clave;
}
function setRol($rol){
    $this->rol=$rol;
}

function setEmail($email){
    $this->email=$email;
}

function getEmail(){
    return $this->email;
}

function getRol(){
    return $this->rol;
}
function getClave(){
    return $this->clave;
}
function getUsuario(){
    return $this->usuario;
}
}
?>
