<?php
namespace model\dao;
//include '../model/dao/DaoObject.php';
//include '../model/dao/DaoConnection.php';

class DaoApadrinajeImpl implements DaoObject{

    public function insert($obj){
     $conexion = DaoConnection::connection();

     $sql="INSERT INTO Apadrinaje(apa_id_padrino, apa_id_ahijado, apa_se_conocen, apa_observaciones, apa_fecha_alta)".
     " VALUES ('$obj->idPadrino','$obj->idAlumno','$obj->seConocen','$obj->observaciones',date_add(sysdate(), INTERVAL -3 hour))";
    //   echo $sql;
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

    public function select($obj){

    }
}


?>
