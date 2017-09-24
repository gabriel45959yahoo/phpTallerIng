<?php
namespace model\dao;
include '../model/dao/DaoConnection.php';
include '../model/dao/DaoObject.php';

class DaoPadrinoImpl implements DaoObject
{

    public function insert($obj)
    {

        
        $conexion = DaoConnection::connection();
        
        $id_doc=$obj->domicilio->id; //esto lo hice por que no se puede poner dos veces -> en el string da error de conversion a string
        $id_datoFact=$obj->domicilioFact->id;

        if($obj->domicilioFact->nombre==null){
             $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,pa_id_domicilio, pa_fecha_alta ) " .
            "VALUES ('$obj->apellido','$obj->nombre','$obj->alia','$obj->dni','$obj->cuil','$obj->email','$obj->telefono','$obj->contacto','$id_doc',sysdate())";
        }else{
             $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,pa_id_domicilio,pa_id_doc_fact, pa_fecha_alta ) " .
            "VALUES ('$obj->apellido','$obj->nombre','$obj->alia','$obj->dni','$obj->cuil','$obj->email','$obj->telefono','$obj->contacto','$id_doc','$id_datoFact',sysdate())";
        }

        
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

    public function select($obj)
    {

        
    }
}

?>
