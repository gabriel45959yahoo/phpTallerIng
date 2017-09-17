<?php
include '../model/dao/entities/UsuarioEntity.php';
include '../model/dao/DaoUsuario.php';
include '..model/dao/DaoConnection.';
class DaoUsuarioImpl implements DaoUsuario{

    var $coneccion= DaoConnection->connection();

     public function esUsuario(UsuarioEntity $usuario){

         $sql_stmt ="SELECT * FROM usuario WHERE usr_id=? and clave=?";

         $preparado=$coneccion->prepare($sql_stmt);
         $preparado->bindParam(1,$usuario->usuario);
         $preparado->bindParam(2, $usuario->clave);

         if($preparado->execute()){
             return true;
         }

         return false;

     }

}
?>
