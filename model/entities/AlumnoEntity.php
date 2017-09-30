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

function __construct($nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact){
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
