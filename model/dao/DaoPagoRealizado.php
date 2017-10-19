<?php
namespace model\dao;
use model\entities\TipoPagoEntity as TipoPagoEntity;

class DaoPagoRealizado implements DaoObject{

    public function insert($obj){

          $conexion = DaoConnection::connection();
        //$id,$montoPago,$idDetallePago,$idApadrinaje,$idFechaPago,$fechaRegistro,$idUsuario
        $sql="INSERT INTO pago_realizado(pr_monto_pago, pr_id_detalle_pago, pr_id_apadrinaje, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario) VALUES ('$obj->montoPago','$obj->idDetallePago','$obj->idApadrinaje','$obj->idFechaPago',date_add(sysdate(), INTERVAL -3 hour),'$obj->idUsuario')";


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
        if($obj!=null){
            $sql="SELECT pr_id, pr_monto_pago, pr_id_detalle_pago, pr_id_apadrinaje, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario FROM pago_realizado WHERE 1";
        }else{
            $sql="SELECT pr_id, pr_monto_pago, pr_id_detalle_pago, pr_id_apadrinaje, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario FROM pago_realizado;";
        }
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$descripcion
                    $resultado[] = new TipoPagoEntity($re[0],$re[1]);

                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }


     public function listTipoPago($obj){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT tp_id,tp_descripcion FROM Tipo_pagos;";

          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$descripcion
                    $resultado[] = new TipoPagoEntity($re[0],$re[1]);

                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
}

?>
