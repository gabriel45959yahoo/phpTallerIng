<?php
namespace model\entities;
class Persona{
    var $nombre;
    var $apellido;
    var $dni;
    function __construct($nombre,$apellido,$dni){
         $this->nombre=$nombre;
         $this->apellido=$apellido;
          $this->dni=$dni;
    }

    public function  getNombre(){
        return $this->nombre;
    }
    public function  getApellido(){
        return $this->apellido;
    }
     public function  setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function  setApellido($apellido){
        $this->apellido=$apellido;
    }
     public function  setDni($dni){
        $this->dni=$dni;
    }

}

?>
