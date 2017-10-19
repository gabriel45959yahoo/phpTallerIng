<?php
namespace model\entities;

class PagoRealizadoEntity{

    var $id;
    var $montoPago;
    var $idDetallePago;
    var $idApadrinaje;
    var $idFechaPago;
    var $fechaRegistro;
    var $idUsuario;

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

function __construct7($id,$montoPago,$idDetallePago,$idApadrinaje,$idFechaPago,$fechaRegistro,$idUsuario){

    $this->id=$id;
    $this->montoPago=$montoPago;
    $this->idDetallePago=$idDetallePago;
    $this->idApadrinaje=$idApadrinaje;
    $this->idFechaPago=$idFechaPago;
    $this->fechaRegistro=$fechaRegistro;
    $this->idUsuario=$idUsuario;
}
function __construct5($montoPago,$idDetallePago,$idApadrinaje,$idFechaPago,$idUsuario){

    $this->montoPago=$montoPago;
    $this->idDetallePago=$idDetallePago;
    $this->idApadrinaje=$idApadrinaje;
    $this->idFechaPago=$idFechaPago;
    $this->idUsuario=$idUsuario;
}
}
?>
