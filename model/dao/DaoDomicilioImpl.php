<?php
namespace model\dao;
use model\entities\DomicilioEntity as DomicilioEntity;

class DaoDomicilioImpl implements DaoObject{

    public function insert($obj){
        $conexion = DaoConnection::connection();

        $sql = "INSERT INTO Domicilio (doc_calle,doc_numero,doc_provincia,doc_ciudad,doc_depto,doc_piso) " .
        "VALUES ('$obj->calle','$obj->numero','$obj->provincia','$obj->ciudad','$obj->depto','$obj->piso')";

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
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT doc_id,doc_calle,doc_numero,doc_piso,doc_depto,doc_provincia,doc_ciudad FROM Domicilio WHERE ".
            "doc_calle='$obj->calle' ".
            (($obj->numero==null)?" ":"and doc_numero='$obj->numero' ").
            (($obj->provincia==null)?" ":"and doc_provincia='$obj->provincia'").
            (($obj->ciudad==null)?" ":"and doc_ciudad='$obj->ciudad'").
            (($obj->depto==null)?" ":"and doc_depto='$obj->depto'").
            (($obj->piso==null)?" ":"and doc_piso='$obj->piso'").
            " order by doc_id desc";
        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {

                   $resultado[]= new DomicilioEntity($re[0],$re[1], (int) $re[2], $re[3],
                                  $re[4], $re[5], $re[6]);
                }
        }

        mysqli_close($conexion);
     return   $resultado;
    }


}


?>
