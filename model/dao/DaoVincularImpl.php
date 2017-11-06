<?php
namespace model\dao;

use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\VincularEntity as VincularEntity;


class DaoVincularImpl implements DaoObject{

    public function insert($obj){
     $conexion = DaoConnection::connection();

     $sql="INSERT INTO Vincular(vin_id_padrino, vin_id_ahijado, vin_se_conocen, vin_fecha_alta)".
     " VALUES ('$obj->idPadrino','$obj->idAlumno','$obj->seConocen',date_add(sysdate(), INTERVAL -3 hour))";
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
    public function delete($obj){

    }
    public function desvincular($obj){
     $conexion = DaoConnection::connection();

     $sql="update Vincular set vin_fecha_baja=date_add(sysdate(), INTERVAL -3 hour) WHERE vin_id='$obj'";
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
        $resultado = array();
        $conexion = DaoConnection::connection();
        if($obj==null){
           $sql="SELECT vin_id,".
            " vin_id_padrino,".
            " vin_id_ahijado,".
            " vin_se_conocen,".
            " vin_fecha_alta,".
            " vin_fecha_baja".
            " FROM Vincular ".
            " order by vin_id desc";
        }else{
            $sql="SELECT vin_id,".
                " vin_id_padrino,".
                " vin_id_ahijado,".
                " vin_se_conocen,".
                " vin_fecha_alta,".
                " vin_fecha_baja".
                " FROM Vincular WHERE ".
                "vin_id_padrino='$obj->idPadrino' ".
                (($obj->idAlumno==null)?" ":"and vin_id_ahijado='$obj->idAlumno'").
                (($obj->seConocen==null)?" ":"and vin_se_conocen='$obj->seConocen'").
                (($obj->fechaAlta==null)?" ":"and vin_fecha_alta='$obj->fechaAlta'").
                (($obj->fechaBaja==null)?" ":"and vin_fecha_baja='$obj->fechaBaja'").
                " order by vin_id desc";
        }
          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
               // $re = array_map('utf8_encode',$re);


                //$id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja
                $resultado[]= new VincularEntity($re[0],$re[1],$re[2],$re[3],null,$re[4],$re[5]);

                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }

    public function listaPadrinoAhijado(){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT vin_id,".
            " pa.pa_id,".
            " pa.pa_nombre,".
            " pa.pa_apellido,".
            " pa.pa_alias,".
            " pa.pa_dni,".
            " pa.pa_cuil,".
            " alu.alu_id, ".
            " alu.alu_nombre,".
            " alu.alu_apellido,".
            " alu.alu_alias,".
            " alu.alu_cursado FROM Vincular vin, Padrino pa, Alumno alu ".
            " where vin.vin_id_padrino=pa.pa_id and vin.vin_id_ahijado=alu.alu_id and vin.vin_fecha_baja is null;";

          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
              //  $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $alu = new AlumnoEntity($re[7],$re[8], $re[9],$re[10],null,$re[11],null,null,null);

                    //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $padrino= new PadrinoEntity($re[1],$re[2], $re[3],$re[4],$re[5], $re[6],null,null, null,null,null, null,null,null,null,null,null);



                //$id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja
                $resultado['data'][]= new VincularEntity($re[0],$padrino,$alu,null,null,null,null);

                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
 public function buscarAhijadosdelPadrino($idPadrino){
         $resultado = array();
        $conexion = DaoConnection::connection();

        $sql="SELECT alu_id,".
            " alu_nombre,".
            " alu_apellido,".
            " alu_alias,".
            " alu_dni,".
            " alu_cursado,".
            " alu_observaciones,".
            " alu_fecha_nacimiento,".
            " alu_es_alumno,".
            "TRUNCATE(DATEDIFF(CURDATE() ,alu_fecha_nacimiento)/365,0) as edad,".
            "vin.vin_id,".
            "ifnull(DATE_FORMAT(max(vin.vin_fecha_alta), '%d/%m/%Y'),'-/-/-'),".
            "ifnull(DATE_FORMAT(max(vin.vin_fecha_baja), '%d/%m/%Y'),'-/-/-')".
            " FROM Vincular vin, Alumno alu ".
            " where vin.vin_id_ahijado=alu.alu_id and vin.vin_id_padrino='$idPadrino' GROUP by vin.vin_id;";

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
             //   $re = array_map('utf8_encode',$re);
                    //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                    $alu=new AlumnoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7],$re[8]);
                   $alu->edad=$re[9];
                  //$id,$idPadrino,$idAlumno,$seConocen,$observaciones,$fechaAlta,$fechaBaja
                $resultado['data'][]= new VincularEntity($re[10],$idPadrino,$alu,null,null,$re[11],$re[12]);
                }
        }

        mysqli_close($conexion);
     return   $resultado;
    }
}


?>
