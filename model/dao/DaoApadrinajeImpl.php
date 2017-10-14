<?php
namespace model\dao;
//include '../model/dao/DaoObject.php';
//include '../model/dao/DaoConnection.php';
//include '../model/entities/AlumnoEntity.php';
use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\ApadrinajeEntity as ApadrinajeEntity;


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

    public function listaPadrinoAhijado(){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT apa_id,pa.pa_id, pa.pa_nombre,pa.pa_apellido,pa.pa_alias,pa.pa_dni,pa.pa_cuil,alu.alu_id, alu.alu_nombre,alu.alu_apellido,alu.alu_alias,alu.alu_cursado FROM Apadrinaje apa, Padrino pa, Alumno alu where apa.apa_id_padrino=pa.pa_id and apa.apa_id_ahijado=alu.alu_id;";

          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $alu = new AlumnoEntity($re[7],$re[8], $re[9],$re[10],null,$re[11],null,null,null);

                    //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $padrino= new PadrinoEntity($re[1],$re[2], $re[3],$re[4],$re[5], $re[6],null,null, null,null,null, null,null,null,null,null,null);



                //$id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja
                $resultado[]= new ApadrinajeEntity($re[0],$padrino,$alu,null,null,null,null);

                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }


}


?>
