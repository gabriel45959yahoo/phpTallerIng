<?php
namespace model\dao;


use model\entities\DetallePagoEntity as DetallePagoEntity;

class DaoDetallePago implements DaoObject{

public function insert($obj){
      $conexion = DaoConnection::connection();
         //$id,$montoPago,$idDetallePago,$idApadrinaje,$idFechaPago,$fechaRegistro,$idUsuario
        $sql="INSERT INTO Detalle_pago(dp_tipo_pago, dp_factura_acredita_pago, dp_comprobante_acredita_pago, dp_descripcion) VALUES ('$obj->idTipoPago','$obj->facturaAcreditaPago','$obj->comprobanteAcreditaPago','$obj->descripcion')";


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
            $sql="SELECT dp_id, dp_tipo_pago, dp_factura_acredita_pago, dp_comprobante_acredita_pago, dp_descripcion FROM Detalle_pago WHERE ".
            (($obj->idTipoPago==null)?" ":" dp_tipo_pago='$obj->idTipoPago' ").
            (($obj->facturaAcreditaPago==null)?" ":"and dp_factura_acredita_pago='$obj->facturaAcreditaPago' ").
            " order by dp_id desc";
        }else{
            $sql="SELECT dp_id, dp_tipo_pago, dp_factura_acredita_pago, dp_comprobante_acredita_pago, dp_descripcion FROM Detalle_pago order by dp_id desc;";
        }
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$idTipoPago,$facturaAcreditaPago,$comprobanteAcreditaPago,$descripcion
                    $resultado[] = new DetallePagoEntity($re[0],$re[1],$re[2],$re[3],$re[4]);
                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }


}

?>
