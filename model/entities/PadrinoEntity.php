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

 public function  getCuil(){
        return $this->cuil;
    }
public function  setCuil($cuil){
        $this->cuil=$cuil;
    }
}
public function  getEmail(){
        return $this->email;
    }
public function  setEmail($email){
        $this->email=$email;
    }
public function  getTelefono(){
        return $this->telefono;
    }
public function  setTelefono($telefono){
        $this->telefono=$telefono;
    }
public function  getContacto(){
        return $this->contacto;
    }
public function  setContacto($contacto){
        $this->contacto=$contacto;
    }
}
public function  getAlia(){
        return $this->alia;
    }
public function  setContacto($alia){
        $this->alia=$alia;
    }
}
?>
