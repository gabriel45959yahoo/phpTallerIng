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
 public function update($obj)
    {

        
        $conexion = DaoConnection::connection();
        
        
        $sql = "update  Padrino set pa_apellido='$obj->apellido' ,  pa_nombre='$obj->nombre' ,  pa_alias='$obj->alia' ,  pa_dni='$obj->dni' ,  pa_cuil='$obj->cuil' ,  pa_email='$obj->email' ,pa_email_alternativo='$obj->emailAlt',  pa_telefono='$obj->telefono' ,pa_telefono_alternativo='$obj->telefonoAlt',  pa_referencia_contacto='$obj->contacto' ,pa_ficha_fisica_ingreso='$obj->fichaFisicaIngreso' where  pa_id='$obj->id'";

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
        if($obj!=null){
            
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
        }else{
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
            " FROM Padrino ". 
            " order by pa_id desc";
        }
       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                
                   $re = array_map('utf8_encode',$re); //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$emailAlt,$telefono,$telefonoAlt,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja,$montoPactado,$fichaFisicaIngreso
                   $resultado["data"][]= new PadrinoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7], $re[8],
                                                   $re[9],$re[10], $re[11],null,$re[12],$re[13],null,$re[14]);
                }
        }

        mysqli_close($conexion);

       // echo $conexion->error;
     return   $resultado;

        
    }
    function buscarPadrinosLibres($obj){
        $resultado = array();
        $conexion = DaoConnection::connection();


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
            " FROM Padrino".
            " order by pa_id desc";
       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       // echo mysqli_num_rows($result);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $resultado["data"][]= new PadrinoEntity($re[0],$re[1], $re[2],
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
        $sql="select count(DISTINCT vin_id_padrino) as total_Padrino,".
            "  null as padrino_libre,".
            "  count(vin_id_ahijado) as alumno_libre".
            "  FROM Vincular where vin_fecha_baja is null".
            " UNION".
            "  select null as total,".
            "  count(1) as padrino_libre,".
            "   null as alumno_libre ".
            "  FROM Padrino WHERE not EXISTS(SELECT 1 FROM Vincular WHERE vin_id_padrino=pa_id and vin_fecha_baja is null)".
            " UNION".
            "  select null as total,".
            "  null as padrino_libre,".
            "  count(1) as alumno_libre".
            "  FROM Alumno WHERE not EXISTS(SELECT 1 FROM Vincular WHERE vin_id_ahijado=alu_id and vin_fecha_baja is null);";
       
          $result = mysqli_query($conexion, $sql);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                   $re = array_map('utf8_encode',$re);
                
                  if($re[0]!=null){
                      $prom->totalPadrino=(int)$re[0];
                      $prom->totalAlumno=(int)$re[2];
                  }else if($re[1]!=null){
                      $prom->padrinoLib=(int)$re[1];
                      
                  }else if($re[2]!=null){
                      $prom->alumnoLib=(int)$re[2];
                      
                  }
                   
                }
           $resultado[]= $prom;
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
        
        
        
    }
   function buscarPadrinosVinculados(){
        $resultado = array();
        $conexion = DaoConnection::connection();


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
            " FROM Padrino where EXISTS(SELECT 1 FROM Vincular WHERE vin_id_padrino=pa_id and vin_fecha_baja is null)".
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
     function buscarHistoricoPadrinosVinculados(){
        $resultado = array();
        $conexion = DaoConnection::connection();


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
            " DATE_FORMAT(pa_fecha_alta, '%d/%m/%Y'),".
            " pa_fecha_baja,".
            " pa_ficha_fisica_ingreso".
            " FROM Padrino pa where EXISTS(select 1 from Vincular vin where vin.vin_id_padrino=pa.pa_id)".
            " order by pa_id desc";
       // echo $sql;

        $result = mysqli_query($conexion, $sql);
       // echo mysqli_num_rows($result);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                  //$id,$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto,$domicilio,$domicilioFact,$fechaAlta,$fechaBaja
                   $resultado["data"][]= new PadrinoEntity($re[0],$re[1], $re[2],
                                                   $re[3],$re[4], $re[5],
                                                   $re[6],$re[7], $re[8],
                                                   $re[9],$re[10], null,null,$re[12],$re[13],null,$re[14]);
                }
        }
        echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
}

?>
