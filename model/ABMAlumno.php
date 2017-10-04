<?php
include '../model/dao/DaoAlumnoImpl.php';
use model\entities\AlumnoEntity as AlumnoEntity;
class ABMAlumno{

    private static $instanciaAlumno;
    /**
     * esto es para que no se cree mas de una vez la clase
     * @return [[Type]] [[Description]]
     */
    public static function singleton_Alumno()
    {

        if (!isset(self::$instanciaAlumno)) {

            $miclaseAlumno = __CLASS__;
            self::$instanciaAlumno = new $miclaseAlumno;

        }

        return self::$instanciaAlumno;

    }
    /**
     * Guardo los datos de un Alumno
     * @param  [[Type]] $padrino [[Description]]
     * @return boolean  [[Description]]
     */
    public function cargarAlumno($alumno)
    {
        try{
        $daoAlumno= new model\dao\DaoAlumnoImpl();
            //$nombre,$apellido,$alias,$dni,$nivelCurso,$observaciones,$fechaNacimiento
        $alumnoConsulta = new AlumnoEntity($alumno->nombre, $alumno->apellido,null,$alumno->dni,null, null,null);
        $resAlumno=$daoAlumno->select($alumnoConsulta);

        if(count($resAlumno)>0){

            return -1;
        }

           $resAlumno=$daoAlumno->insert($alumno);
            //echo $resAlumno;
            if($resAlumno=="OK"){
                    return 0;
                }else{
                    echo $resAlumno;
                    return 1;
                }
       }catch (Exception $e) {
                return 'Error: '.$e->getMessage(). "\n";
        }
    }
    public function buscarAlumnosLibres($alumno){
        $daoAlumno= new model\dao\DaoAlumnoImpl();

      if($alumno==null){

        $alumnoConsulta = new AlumnoEntity(null, null,null,null, null,null,null);
      }else{
        $alumnoConsulta = new AlumnoEntity($alumno->nombre, $alumno->apellido,null,$alumno->dni,null, null,null);
      }
      $resultado=$daoAlumno->buscarAlumnosLibres($alumnoConsulta);

      return $resultado;
    }
    /**
     * Generar error al intentar clonar el obj de la clase
     * @private
     */
    public function __clone()
    {

        trigger_error('La clonaciónn de este objeto no está permitida', E_USER_ERROR);

    }

}


?>
