<?php
namespace model\dao;
 interface DaoUsuario {
    public function esUsuario($usuario);
    public function cambiarClave($usuario, $claveActual, $claveNueva, $confirmacion);
    public function crearUsuario($user);
}
?>

