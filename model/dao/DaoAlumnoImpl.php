<?php
namespace model\dao;
//include '../model/dao/DaoConnection.php';
//include '../model/dao/DaoObject.php';
use model\entities\AlumnoEntity as AlumnoEntity;

class DaoAlumnoImpl implements DaoObject
{

    public function insert($obj)
    {


        $conexion = DaoConnection::connection();

         $sql = "INSERT INTO Alumno(alu_nombre, alu_apellido,alu_alias, alu_cursado, alu_observaciones,alu_dni,alu_fecha_nacimiento) " .
            "VALUES ('$obj->nombre','$obj->apellido','$obj->alias','$obj->nivelCurso','$obj->observaciones','$obj->dni',STR_TO_DATE('$obj->fechaNacimiento', '%Y-%m-%d'))";



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
    public function update($obj)
    {


        $conexion = DaoConnection::connection();

         $sql = "update Alumno set alu_nombre='$obj->nombre', alu_apellido='$obj->apellido',alu_alias='$obj->alias', alu_cursado='$obj->nivelCurso', alu_observaciones='$obj->observaciones',alu_dni='$obj->dni',alu_fecha_nacimiento=STR_TO_DATE('$obj->fechaNacimiento', '%d/%m/%Y') where alu_id='$obj->id'";



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
         $resAlumno = array();
        $conexion = DaoConnection::connection();

        if($obj != null){
            $sql="SELECT alu_id,". //0
                " alu_nombre,".
                " alu_apellido,".
                " alu_alias,".
                " alu_dni,".
                " alu_cursado,".
                " alu_observaciones,".
                " ifnull(DATE_FORMAT(alu_fecha_nacimiento, '%d/%m/%Y'),'-/-/-') as fecha_nacimiento,".
                " alu_es_alumno,".
                " TIMESTAMPDIFF(YEAR, alu_fecha_nacimiento, CURDATE()) as edad".
                " FROM Alumno WHERE ".
                "alu_apellido='$obj->apellido' ".
                (($obj->nombre==null)?" ":"and alu_nombre='$obj->nombre' ").
                (($obj->nivelCurso==null)?" ":"and alu_cursado='$obj->nivelCurso'").
                (($obj->fechaNacimiento==null)?" ":"and alu_fecha_nacimiento='$obj->fechaNacimiento'").
                (($obj->dni==null)?" ":"and alu_dni='$obj->dni'").
                " order by alu_id desc";
        }else{
             $sql="SELECT alu_id,". //0
                " alu_nombre,".
                " alu_apellido,".
                " alu_alias,".
                " alu_dni,".
                " alu_cursado,".
                " alu_observaciones,".
                " ifnull(DATE_FORMAT(alu_fecha_nacimiento, '%d/%m/%Y'),'-/-/-') as fecha_nacimiento,".
                " alu_es_alumno,".
                " TIMESTAMPDIFF(YEAR, alu_fecha_nacimiento, CURDATE()) as edad".
                " FROM Alumno ".
                " order by alu_id desc";
        }

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
               // $re = array_map('utf8_encode',$re);
                    //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                  $alu=new AlumnoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7],$re[8]);

                  $alu->setEdad($re[9]);
                   $resAlumno["data"][]=$alu;
                }
        }

        mysqli_close($conexion);
     return   $resAlumno;


    }
    public function buscarAlumnosLibres($obj){
         $resAlumno = array();
        $conexion = DaoConnection::connection();

        //SELECT alu_id, alu_nombre, alu_apellido, alu_cursado, alu_observaciones, alu_es_alumno, alu_fecha_nacimiento FROM Alumno WHERE 1
        $sql="SELECT alu_id,". //0
            " alu_nombre,".
            " alu_apellido,".
            " alu_alias,".
            " alu_dni,".
            " alu_cursado,".
            " alu_observaciones,".
            " alu_fecha_nacimiento,".
            " alu_es_alumno".
            " FROM Alumno WHERE not EXISTS(SELECT 1 FROM Vincular WHERE vin_id_ahijado=alu_id and vin_fecha_baja is null) ".
            (($obj->apellido==null)?" ":"and alu_apellido='$obj->apellido' ").
            (($obj->nombre==null)?" ":"and alu_nombre='$obj->nombre' ").
            (($obj->nivelCurso==null)?" ":"and alu_cursado='$obj->nivelCurso'").
            (($obj->fechaNacimiento==null)?" ":"and alu_fecha_nacimiento='$obj->fechaNacimiento'").
            (($obj->dni==null)?" ":"and alu_dni='$obj->dni'").
            " order by alu_id desc";


        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
               // $re = array_map('utf8_encode',$re);
                    //$id,$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $resAlumno["data"][]= new AlumnoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7],$re[8]);
                }
        }

        mysqli_close($conexion);
     return   $resAlumno;
    }

}

?>
