<?php
namespace model\dao;
use model\entities\TipoPagoEntity as TipoPagoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\VincularEntity as VincularEntity;
use model\entities\EstadoPlan as EstadoPlan;
use model\entities\DetallePagoEntity as DetallePagoEntity;
use model\entities\PagoRealizadoEntity as PagoRealizadoEntity;

class DaoPagoRealizado implements DaoObject{

    public function insert($obj){

          $conexion = DaoConnection::connection();
        //$id,$montoPago,$idDetallePago,$idVincular,$idFechaPago,$fechaRegistro,$idUsuario
        $sql="INSERT INTO Pago_realizado(pr_monto_pago, pr_id_detalle_pago, pr_id_vincular, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario) VALUES ('$obj->montoPago','$obj->idDetallePago','$obj->idVincular',STR_TO_DATE('$obj->idFechaPago', '%d/%m/%Y'),date_add(sysdate(), INTERVAL -3 hour),'$obj->idUsuario')";


        if ($conexion->query($sql) == TRUE) {
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
            $sql="SELECT pr_id, pr_monto_pago, pr_id_detalle_pago, pr_id_vincular, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario FROM Pago_realizado WHERE 1";
        }else{
            $sql="SELECT pr_id, pr_monto_pago, pr_id_detalle_pago, pr_id_vincular, pr_id_fecha_pago, pr_fecha_registro, pr_id_usuario FROM Pago_realizado;";
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

     public function listaPlanCompletadoPadrino(){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT vin_id,".
            "pa.pa_id, ".
            "pa.pa_nombre,".
            "pa.pa_apellido,".
            "pa.pa_alias,".
            "pa.pa_dni,".
            "pa.pa_cuil,".
            "alu.alu_id, ".
            "alu.alu_nombre,".
            "alu.alu_apellido,".
            "alu.alu_alias,".
            "alu.alu_cursado,".
            "ifnull(TRUNCATE(sum(pr.pr_monto_pago)*100/pp.pp_monto_total,2),0) as porcentajePagado, ".
            "ifnull(count(pr.pr_id_vincular),0) as cuotasPagas, ".
            "ifnull(DATE_FORMAT(max(pr.pr_id_fecha_pago), '%d/%m/%Y'),'-/-/-') as fechaUltimaPaga ".
            "FROM Pago_realizado pr RIGHT JOIN Vincular vin on(pr.pr_id_vincular=vin.vin_id)  ".
            "LEFT JOIN  Plan_pactado pp on(vin.vin_id_padrino=pp.pp_pa_id) ".
            "INNER JOIN Padrino pa on(vin.vin_id_padrino=pa.pa_id) ".
            "INNER JOIN Alumno alu on(vin.vin_id_ahijado=alu.alu_id) ".
            "where vin.vin_fecha_baja is null ".
            "group by vin.vin_id;";

          $result = mysqli_query($conexion, $sql);

        if(empty($result)){
            return   $resultado;
        }

       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $alu = new AlumnoEntity($re[7],$re[8], $re[9],$re[10],null,$re[11],null,null,null);

                    //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $padrino= new PadrinoEntity($re[1],$re[2], $re[3],$re[4],null, null,null,null, null,null,null, null,null,null,null,null,null);

                //$porcentajePagado,$cuotasPagas,$fechaUltimaPaga
                $pagoCompletado= new EstadoPlan($re[12],$re[13], $re[14]);
                //$id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja
                $vinculardos=new VincularEntity($re[0],$padrino,$alu,null,null,null,null);
                $vinculardos->estadoPlanPactado=$pagoCompletado;
                $resultado['data'][]= $vinculardos;
                }
        }

        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
  public function detallePagosPadrinos($idVinculado,$fechaDesde,$fechahasta){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT pr.pr_monto_pago,".
            "ifnull(DATE_FORMAT(pr.pr_id_fecha_pago, '%d/%m/%Y'),'-/-/-'),".
            "ifnull(DATE_FORMAT(pr.pr_fecha_registro, '%d/%m/%Y'),'-/-/-'),".
            "pr.pr_id_usuario,".
            "pp.pp_monto_total,".
            "dp.dp_tipo_pago,".
            "tp.tp_descripcion,".
            "dp.dp_factura_acredita_pago,".
            "dp.dp_comprobante_acredita_pago,".
            "dp.dp_descripcion ".
            "FROM Pago_realizado pr RIGHT JOIN Vincular vin on(pr.pr_id_vincular=vin.vin_id) ".
            "LEFT JOIN  Plan_pactado pp on(vin.vin_id_padrino=pp.pp_pa_id)  ".
            "LEFT JOIN Detalle_pago dp ON(dp.dp_id=pr.pr_id_detalle_pago)  ".
            "LEFT JOIN Tipo_pagos tp ON(tp.tp_id=dp.dp_tipo_pago) ".
            "where vin.vin_id='$idVinculado' ".
            "and pr.pr_id_fecha_pago BETWEEN STR_TO_DATE('$fechaDesde', '%d/%m/%Y') and STR_TO_DATE('$fechahasta', '%d/%m/%Y')".
            "ORDER BY vin.vin_id ASC ";

          $result = mysqli_query($conexion, $sql);

       if(empty($result)){
            return   $resultado;
        }
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);

                //$idTipoPago,$facturaAcreditaPago,$comprobanteAcreditaPago,$descripcion)
                $detallePago=new DetallePagoEntity(new TipoPagoEntity($re[5],$re[6]),$re[7],$re[8],$re[9]);

                 //$id,$montoPago,$idDetallePago,$idVincular,$idFechaPago,$fechaRegistro,$idUsuario
                $PagoRealizado=new PagoRealizadoEntity(null,$re[0],$detallePago,$idVinculado,$re[1],$re[2],$re[3]);

                $resultado['data'][]= $PagoRealizado;
                }

        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }


}

?>
