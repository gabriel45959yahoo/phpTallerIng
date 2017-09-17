<?php
include './Persona.php';
class PadrinoEntity extends Persona{

    var $cuil;
    var $email;
    var $telefono;
    var $contacto;
    var $apellido;
    var $nombre;
    var $apellido;
    var $nombre;
    var $apellido;
    var $nombre;
    var $apellido;
    var $alia;

function __construct($nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto){
    parent::__construct($nombre,$apellido,$dni);
    $this->cuil=$cuil;
    $this->email=$email;
    $this->telefono=$telefono;
    $this->contacto=$contacto;
    $this->alia=$alia;
}
}
?>
