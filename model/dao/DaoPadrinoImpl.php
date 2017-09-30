<?php
namespace model\dao;
include '../model/dao/DaoConnection.php';
include '../model/dao/DaoObject.php';
use model\entities\PadrinoEntity as PadrinoEntity;

class DaoPadrinoImpl implements DaoObject
{

    public function insert($obj)
    {

        
        $conexion = DaoConnection::connection();
        
        $id_doc=$obj->domicilio->id; //esto lo hice por que no se puede poner dos veces -> en el string da error de conversion a string
        $id_datoFact=$obj->domicilioFact->id;

        if($obj->domicilioFact->nombre==null){
             $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,pa_id_domicilio, pa_fecha_alta ) " .
            "VALUES ('$obj->apellido','$obj->nombre','$obj->alia','$obj->dni','$obj->cuil','$obj->email','$obj->telefono','$obj->contacto','$id_doc',sysdate())";
        }else{
             $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,  pa_telefono ,  pa_contacto ,pa_id_domicilio,pa_id_doc_fact, pa_fecha_alta ) " .
            "VALUES ('$obj->apellido','$obj->nombre','$obj->alia','$obj->dni','$obj->cuil','$obj->email','$obj->telefono','$obj->contacto','$id_doc','$id_datoFact',sysdate())";
        }

        
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
         $resultado = array();
        $conexion = DaoConnection::connection();
        $idDom=0;
        $idDomFact=0;
        if($obj->domicilio!=null){

           $idDom=$obj->domicilio->id;
        }

        if($obj->domicilioFact!=null){

           $idDomFact=$obj->domicilioFact->id;
        }
        $sql="SELECT pa_id,". //0
            " pa_nombre,".
            " pa_apellido,".
            " pa_alias,".
            " pa_dni,".
            " pa_cuil,".//5
            " pa_email,".
            " pa_telefono,".
            " pa_contacto,".
            " pa_id_domicilio,".
            " pa_id_doc_fact,".//10
            " pa_fecha_alta,".
            " pa_fecha_baja".
            " FROM Padrino WHERE ".
            "pa_apellido='$obj->apellido' ".
            (($obj->nombre==null)?" ":"and pa_nombre='$obj->nombre' ").
            (($obj->alia==null)?" ":"and pa_alias='$obj->alia'").
            (($obj->dni==null)?" ":"and pa_dni='$obj->dni'").
            (($obj->cuil==null)?" ":"and pa_cuil='$obj->cuil'").
            (($obj->email==null)?" ":"and pa_email='$obj->email'").
            (($obj->telefono==null)?" ":"and pa_telefono='$obj->telefono'").
            (($obj->contacto==null)?" ":"and pa_contacto='$obj->contacto'").
            (($idDom==0)?" ":"and pa_id_domicilio='$idDom'").
            (($obj->fechaAlta==null)?" ":"and pa_fecha_alta='$obj->fechaAlta'").
            (($obj->fechaBaja==null)?" ":"and pa_fecha_baja='$obj->fechaBaja'").
            (($idDomFact==0)?" ":"and pa_id_doc_fact='$idDomFact'").
            " order by pa_id desc";

       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                    //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $resultado[]= new PadrinoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7], $re[8],
                                                   $re[9],$re[10], $re[11], $re[12]);
                }
        }

        mysqli_close($conexion);
     return   $resultado;

        
    }
}

?>
