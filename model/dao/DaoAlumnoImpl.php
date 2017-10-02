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

         $sql = "INSERT INTO Alumno(alu_nombre, alu_apellido, alu_cursado, alu_observaciones,alu_dni,alu_fecha_nacimiento) " .
            "VALUES ('$obj->nombre','$obj->apellido','$obj->nivelCurso','$obj->observaciones','$obj->dni',STR_TO_DATE('$obj->fechaNacimiento', '%Y-%m-%d'))";



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

        //SELECT alu_id, alu_nombre, alu_apellido, alu_cursado, alu_observaciones, alu_es_alumno, alu_fecha_nacimiento FROM Alumno WHERE 1
        $sql="SELECT alu_id,". //0
            " alu_nombre,".
            " alu_apellido,".
            " alu_dni,".
            " alu_cursado,".
            " alu_observaciones,".
            " alu_fecha_nacimiento,".
            " alu_es_alumno".
            " FROM Alumno WHERE ".
            "alu_apellido='$obj->apellido' ".
            (($obj->nombre==null)?" ":"and alu_nombre='$obj->nombre' ").
            (($obj->nivelCurso==null)?" ":"and alu_cursado='$obj->nivelCurso'").
            (($obj->fechaNacimiento==null)?" ":"and alu_fecha_nacimiento='$obj->fechaNacimiento'").
            (($obj->dni==null)?" ":"and alu_dni='$obj->dni'").
            " order by alu_id desc";


        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                    //$id,$nombre,$apellido,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $resAlumno[]= new AlumnoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7]);
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
            " alu_dni,".
            " alu_cursado,".
            " alu_observaciones,".
            " alu_fecha_nacimiento,".
            " alu_es_alumno".
            " FROM Alumno WHERE not EXISTS(SELECT 1 FROM Apadrinaje WHERE apa_id_ahijado=alu_id) ".
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
                    //$id,$nombre,$apellido,$dni,$nivelCurso,$observaciones,$fechaNacimiento,$esAlumno
                   $resAlumno[]= new AlumnoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7]);
                }
        }

        mysqli_close($conexion);
     return   $resAlumno;
    }
}

?>
