<?php
namespace model\entities;

class ObsVincularEntity{
    var $id;
    var $idVincular;
    var $observaciones;

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
function __construct3($id,$idVincular,$observaciones){

    $this->id=$id;
    $this->idVincular=$idVincular;
    $this->observaciones=$observaciones;

}
 function __construct2($idVincular,$observaciones){

    $this->idVincular=$idVincular;
    $this->observaciones=$observaciones;

}
}
?>
