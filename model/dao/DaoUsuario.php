<?php
include '../model/dao/entities/UsuarioEntity.php';
/**
*/
interface DaoUsuaio implements DaoUsuarioImpl {
    public function esUsuario(UsuarioEntity $usuario);
}
?>
