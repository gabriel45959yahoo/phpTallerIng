<?php
namespace model\dao;

class DaoObsVincularImpl implements DaoObject{

     public function insert($obj)
    {


        $conexion = DaoConnection::connection();

         $sql = "INSERT INTO oservaciones_vincular( obs_vin_id, obs_observacion,obs_fecha_alta) " .
            "VALUES ('$obj->idVincular','$obj->observaciones',date_add(sysdate(), INTERVAL -3 hour))";



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
         $resObsVincular = array();
        $conexion = DaoConnection::connection();


        $sql="SELECT obs_id,". //0
            " obs_vin_id,".
            " obs_observacion,".
            " obs_fecha_alta,".
            " FROM oservaciones_vincular WHERE ".
            "obs_vin_id='$obj->idVincular' ".
            (($obj->observaciones==null)?" ":"and obs_observacion='$obj->observaciones' ").
            " order by obs_id desc";


        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                //$re = array_map('utf8_encode',$re);
                    //$id,$idVincular,$observacion
                   $resObsVincular["data"][]= new ObsVincularEntity($re[0],$re[1], $re[2],$re[3]);
                }
        }

        mysqli_close($conexion);
     return   $resObsVincular;


    }
}
?>
