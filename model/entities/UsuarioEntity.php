<?php
class UsuarioEntity{
    var $usuario;
    var $clave;
    var $rol;
    var $nombre;
    var $apellido;
    var $email;

    public function getUsuario() :String {
        return $this->usuario;
    }
    public function getClave() :String {
        return $this->clave;
    }
    public function  getRol(){
        return $this->rol;
    }
    public function  getNombre(){
        return $this->nombre;
    }
    public function  getApellido(){
        return $this->apellido;
    }
    public function  getEmail(){
        return $this->email;
    }
    public function  setUsuario($usuario){
        $this->usuario=$usuario;
    }
    public function  setClave($clave){
        $this->clave=$clave;
    }
    public function  setRol($rol){
        $this->rol=$rol;
    }
    public function  setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function  setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setEmail($email){
        $this->email=$email;
    }
}
?>
