<?php
namespace model\entities;

class DetallePagoEntity{

 /*dp_id, dp_tipo_pago, dp_factura_acredita_pago, dp_comprobante_acredita_pago, dp_descripcion*/

    var $id;
    var $idTipoPago;
    var $facturaAcreditaPago;
    var $comprobanteAcreditaPago;
    var $descripcion;

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

function __construct5($id,$idTipoPago,$facturaAcreditaPago,$comprobanteAcreditaPago,$descripcion){

    $this->id=$id;
    $this->idTipoPago=$idTipoPago;
    $this->facturaAcreditaPago=$facturaAcreditaPago;
    $this->comprobanteAcreditaPago=$comprobanteAcreditaPago;
    $this->descripcion=$descripcion;

}
    function __construct4($idTipoPago,$facturaAcreditaPago,$comprobanteAcreditaPago,$descripcion){

    $this->idTipoPago=$idTipoPago;
    $this->facturaAcreditaPago=$facturaAcreditaPago;
    $this->comprobanteAcreditaPago=$comprobanteAcreditaPago;
    $this->descripcion=$descripcion;

}
}
?>
