<?php
require '../model/dao/DaoConnection.php';

class DaoPadrinoImpl {
      public function insertPadrino($padrino){
        $conexion= DaoConnection::connection();
        $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,  pa_fecha_alta ) ".
        "VALUES ('$padrino->getApellido()','$padrino->getNombre()','$padrino->alia','$padrino->getDni()','$padrino->cuil','$padrino->email','$padrino->telefono','$padrino->contacto',sysdate())";

    if ($conexion->query($sql) === TRUE) {
        mysqli_commit($conexion);
        mysqli_close($conexion);
        return "OK";
    } else {
        $error=$conexion->error;
        mysqli_rollback($conexion);
        mysqli_close($conexion);
        return "Error: " .$error;
    }
      }
}

?>
