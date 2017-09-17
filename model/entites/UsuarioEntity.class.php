<?php
class UsuarioEntity{
    $usuario;
    $clave;
    $rol;
    $nombre;
    $apellido;
    $email;
    public getUsuario(){
        return $this->usuario;
    }
    public getClave(){
        return $this->clave;
    }
    public getRol(){
        return $this->rol;
    }
    public getNombre(){
        return $this->nombre;
    }
    public getApellido(){
        return $this->apellido;
    }
    public getEmail(){
        return $this->email;
    }
    public setUsuario($usuario){
        $this->usuario=$usuario;
    }
    public setClave($clave){
        $this->clave=$clave;
    }
    public setRol($rol){
        $this->rol=$rol;
    }
    public setNombre($nombre){
        $this->nombre=$nombre;
    }
    public setApellido($apellido){
        $this->apellido=$apellido;
    }
    public setEmail($email){
        $this->email=$email;
    }
}
?>
