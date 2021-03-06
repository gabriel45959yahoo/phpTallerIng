<?php
namespace model\entities;

class AlumnoEntity extends Persona{
    var $id;
    var $nivelCurso;
    var $fechaNacimiento;
    var $observaciones;
    var $esAlumno;
    var $alias;
    var $edad;


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
function __construct9($id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno){
    parent::__construct($nombre,$apellido,$dni);
    $this->id=$id;
    $this->nivelCurso=$nivelCurso;
    $this->observaciones=$observaciones;
    $this->fechaNacimiento=$fechaNacimiento;
    $this->esAlumno=$esAlumno;
    $this->alias=$alias;

}
function __construct7($nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento){
    parent::__construct($nombre,$apellido,$dni);
    $this->nivelCurso=$nivelCurso;
    $this->observaciones=$observaciones;
    $this->fechaNacimiento=$fechaNacimiento;
    $this->alias=$alias;
}

     public function  getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
     public function  getContacto(){
        return $this->contacto;
    }
     public function  getObservaciones(){
        return $this->observaciones;
    }
     public function  getNivelCurso(){
        return $this->nivelCurso;
    }
     public function  getId(){
        return $this->id;
    }
     public function  getAlias(){
        return $this->alias;
    }
     public function  getEdad(){
        return $this->edad;
    }
     public function  setEdad($edad){
        $this->edad=$edad;
    }
     public function  setAlias($alias){
        $this->alias=$alias;
    }
     public function  setId($id){
        $this->id=$id;
    }
     public function  setNivelCurso($nivelCurso){
        $this->nivelCurso=$nivelCurso;
    }
     public function  setObservaciones($observaciones){
        $this->observaciones=$observaciones;
    }
     public function  setContacto($contacto){
        $this->telefono=$contacto;
    }
     public function  setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento=$fechaNacimiento;
    }
}
?>
