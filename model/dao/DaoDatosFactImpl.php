<?php
namespace model\dao;
use model\entities\DatosFactEntity as DatosFactEntity;
use model\entities\DomicilioEntity as DomicilioEntity;
class DaoDatosFactImpl implements DaoObject{
    /**
     * agrego una forma de facturacion
     * @param [[Type]] $obj [[Description]]
     */
    public function insert($obj){
        $conexion = DaoConnection::connection();

        $id_doc=(int)$obj->domicilio->id; //esto lo hice por que no se puede poner dos veces -> en el string da error de conversion a string

        $sql = "INSERT INTO Datos_facturacion( df_nombre,df_apellido,df_id_domicilio,df_dni,df_cuil_cuit,df_id_padrino,df_fecha_alta) " .
            "VALUES ('$obj->nombre','$obj->apellido','$id_doc','$obj->dni','$obj->cuil','$obj->idPadrino',date_add(sysdate(), INTERVAL -3 hour))";

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
    /**
     * busco los datos de facturacion guardados
     * @param [[Type]] $obj [[Description]]
     */
    public function select($obj){
        $resultado = array();
        $conexion = DaoConnection::connection();

       $sql="SELECT df_id, df_nombre, df_apellido,df_dni, df_email, df_cuil, df_telefono, df_fecha_alta, df_fecha_baja,doc_id,doc_calle,doc_numero,doc_piso,doc_depto,doc_provincia,doc_ciudad FROM Datos_facturacion df, Domicilio doc WHERE df.df_id_domicilio=doc.doc_id ".
            (($obj->nombre==null)?" ":"and df_nombre='$obj->nombre' ").
            (($obj->apellido==null)?" ":"and df_apellido='$obj->apellido' ").
            (($obj->dni==null)?" ":"and df_dni='$obj->dni'").
            (($obj->email==null)?" ":"and df_email='$obj->email'").
            (($obj->cuil==null)?" ":"and df_cuil='$obj->cuil'").
            (($obj->telefono==null)?" ":"and df_telefono='$obj->telefono'").
            " order by df_id desc";


        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                     //$id,$calle,$numero,$piso,$depto,$provincia,$ciudad
                    $domi = new DomicilioEntity($re[9],$re[10], (int) $re[11], $re[12], $re[13], $re[14], $re[15]);
                    //$id,$nombre,$apellido,$dni,$email,$cuil,$telefono,$domicilio,$fechaAlta,$fecjaBaja
                    $resultado[] = new DatosFactEntity($re[0],$re[1],$re[2],$re[3],$re[4],$re[5],$re[6],$domi,$re[7],$re[8]);
                }
        }

        mysqli_close($conexion);
     return   $resultado;
    }
    /**
     * [[Description]]
     * @param [[Type]] $idPadrino [[Description]]
     */
    public function buscarDomFactPorPadrino($idPadrino){
       $resultado = array();
        $conexion = DaoConnection::connection();

       $sql="SELECT df_id, df_nombre, df_apellido,df_dni, df_cuil_cuit, df_fecha_alta,doc_id,doc_calle,doc_numero,doc_piso,doc_depto,doc_provincia,doc_ciudad FROM Datos_facturacion df, Domicilio doc WHERE df.df_id_domicilio=doc.doc_id ". "and df_id_padrino=$idPadrino".
            " order by df_id desc";
      //  echo $sql;

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                     //$id,$calle,$numero,$piso,$depto,$provincia,$ciudad
                    $domi = new DomicilioEntity($re[6],$re[7], (int) $re[8], $re[9], $re[10], $re[11], $re[12]);
                    //$id,$nombre,$apellido,$dni,$cuil,$domicilio,$fechaAlta,$idPadrino
                    $resultado[] = new DatosFactEntity($re[0],$re[1],$re[2],$re[3],$re[4],$domi,$re[5],null);
                }
        }

        mysqli_close($conexion);
     return   $resultado;
    }
}

?>
