<?php
namespace model\dao;
include '../model/dao/DaoObject.php';
include '../model/dao/DaoConnection.php';

use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\PorcLibOcup as PorcLibOcup;
//use model\dao\DaoObject as DaoObject;

class DaoPadrinoImpl implements DaoObject{

    public function insert($obj)
    {

        
        $conexion = DaoConnection::connection();
        
        $id_doc=$obj->domicilio->id; //esto lo hice por que no se puede poner dos veces -> en el string da error de conversion a string
        
        $sql = "INSERT INTO  Padrino ( pa_apellido ,  pa_nombre ,  pa_alias ,  pa_dni ,  pa_cuil ,  pa_email ,pa_email_alternativo,  pa_telefono ,pa_telefono_alternativo,  pa_referencia_contacto ,pa_id_domicilio,pa_ficha_fisica_ingreso, pa_fecha_alta ) " .
            "VALUES ('$obj->apellido','$obj->nombre','$obj->alia','$obj->dni','$obj->cuil','$obj->email','$obj->emailAlt','$obj->telefono','$obj->telefonoAlt','$obj->contacto','$id_doc','$obj->fichaFisicaIngreso',date_add(sysdate(), INTERVAL -3 hour))";

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
        if($obj->domicilio!=null){

           $idDom=$obj->domicilio->id;
        }


        $sql="SELECT pa_id,". //0
            " pa_nombre,".
            " pa_apellido,".
            " pa_alias,".
            " pa_dni,".
            " pa_cuil,".//5
            " pa_email,".
            " pa_email_alternativo,".
            " pa_telefono,".
            " pa_telefono_alternativo,".
            " pa_referencia_contacto,".//10
            " pa_id_domicilio,".
            " pa_fecha_alta,".
            " pa_fecha_baja,".
            " pa_ficha_fisica_ingreso".
            " FROM Padrino WHERE ".
            "pa_apellido='$obj->apellido' ".
            (($obj->nombre==null)?" ":"and pa_nombre='$obj->nombre' ").
            (($obj->alia==null)?" ":"and pa_alias='$obj->alia'").
            (($obj->dni==null)?" ":"and pa_dni='$obj->dni'").
            (($obj->cuil==null)?" ":"and pa_cuil='$obj->cuil'").
            (($obj->email==null)?" ":"and pa_email='$obj->email'").
            (($obj->telefono==null)?" ":"and pa_telefono='$obj->telefono'").
            (($obj->contacto==null)?" ":"and pa_referencia_contacto='$obj->contacto'").
            (($idDom==0)?" ":"and pa_id_domicilio='$idDom'").
            (($obj->fechaAlta==null)?" ":"and pa_fecha_alta='$obj->fechaAlta'").
            (($obj->fechaBaja==null)?" ":"and pa_fecha_baja='$obj->fechaBaja'").
            " order by pa_id desc";

       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                
                   $re = array_map('utf8_encode',$re); //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$emailAlt,$telefono,$telefonoAlt,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja,$montoPactado,$fichaFisicaIngreso
                   $resultado[]= new PadrinoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7], $re[8],
                                                   $re[9],$re[10], null,null,$re[12],$re[13],null,$re[14]);
                }
        }

        mysqli_close($conexion);

       // echo $conexion->error;
     return   $resultado;

        
    }
    function buscarPadrinosLibres($obj){
        $resultado = array();
        $conexion = DaoConnection::connection();

        $idDom=0;
        if($obj->domicilio!=null){

           $idDom=$obj->domicilio->id;
        }
        $sql="SELECT pa_id,". //0
            " pa_nombre,".
            " pa_apellido,".
            " pa_alias,".
            " pa_dni,".
            " pa_cuil,".//5
            " pa_email,".
            " pa_email_alternativo,".
            " pa_telefono,".
            " pa_telefono_alternativo,".
            " pa_referencia_contacto,".//10
            " pa_id_domicilio,".
            " pa_fecha_alta,".
            " pa_fecha_baja,".
            " pa_ficha_fisica_ingreso".
            " FROM Padrino WHERE not EXISTS(SELECT 1 FROM Apadrinaje WHERE apa_id_padrino=pa_id) ".
            (($obj->apellido==null)?" ":"and pa_apellido='$obj->apellido' ").
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
            " order by pa_id desc";

       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       // echo mysqli_num_rows($result);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $resultado[]= new PadrinoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7], $re[8],
                                                   $re[9],$re[10], null,null,$re[12],$re[13],null,$re[14]);
                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
    function listarPadrinoLibrePadrinoOcupado(){
        $resultado = array();
        $conexion = DaoConnection::connection();
        $prom = new PorcLibOcup();
        $sql="sselect count(1) as total, null as padrino_libre, null as alumno_libre FROM Apadrinaje 
UNION 
select null as total, count(1) as padrino_libre,  null as alumno_libre FROM Padrino WHERE not EXISTS(SELECT 1 FROM Apadrinaje WHERE apa_id_padrino=pa_id) 
UNION 
select null as total, null as padrino_libre, count(1) as alumno_libre FROM Alumno WHERE not EXISTS(SELECT 1 FROM Apadrinaje WHERE apa_id_ahijado=alu_id);";
       
          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                   $re = array_map('utf8_encode',$re);
                
                  if($re[0]!=null){
                      $prom->total=$re[0];
                  }else if($re[1]!=null){
                      $prom->padrinoLib=$re[1];
                      
                  }else if($re[2]!=null){
                      $prom->alumnoLib=$re[2];
                      
                  }
                   
                }
           $resultado[]= $prom;
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
        
        
        
    }
    
    
}

?>
