<?php
namespace model\dao;
use model\entities\TipoPagoEntity as TipoPagoEntity;

class DaoPagoRealizado implements DaoObject{

    public function insert($obj){

        }

    public function select($obj){
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
