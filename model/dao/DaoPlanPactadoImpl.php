<?php
namespace model\dao;

class DaoPlanPactadoImpl implements DaoObject{

    public function insert($obj){
          $conexion = DaoConnection::connection();

         $sql = "INSERT INTO Plan_pactado(pp_pa_id, pp_monto_total, pp_year_lectivo) " .
            "VALUES ('$obj->idPadrino','$obj->montoTotal',now()-3)";

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
