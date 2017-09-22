<?php
namespace model\dao;
include '../model/dao/DaoConnection.php';
include '../model/dao/DaoPadrino.php';
include '../model/dao/DaoDomicilioImpl.php';

class DaoPadrinoImpl implements DaoPadrino
{

    public function insertPadrino($padrino)
    {
        $resDoc= DaoDomicilioImpl::   
        
        $conexion = DaoConnection::connection();
        
        $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,  pa_fecha_alta ) " .
        "VALUES ('$padrino->apellido','$padrino->nombre','$padrino->alia','$padrino->dni','$padrino->cuil','$padrino->email','$padrino->telefono','$padrino->contacto',sysdate())";
        
        if ($conexion->query($sql) === TRUE) {
            mysqli_commit($conexion);
            mysqli_close($conexion);
            return "OK";
        } else {
            $error = $conexion->error;
            mysqli_rollback($conexion);
            mysqli_close($conexion);
            return "Error: " . $error;
        }
    }

    public function selectPadrino($padrino)
    {
       
        
    }
}

?>
