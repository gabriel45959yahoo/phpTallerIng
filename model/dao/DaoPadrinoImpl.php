<?php
require '../model/dao/DaoConnection.php';
include './DaoPadrino.php';
class DaoPadrinoImpl implements DaoPadrino{
      public function insertPadrino($padrino){
        $conexion= DaoConnection::connection();
          $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,  pa_fecha_alta ) VALUES ('$padrino->apellido',' $padrino->nombre,$this->alia,'$this->dni','$this->cuil','$this->email','$this->telefono',$this->contact,sysdate())";

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
