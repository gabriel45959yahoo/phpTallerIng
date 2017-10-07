<?php
namespace model\dao;

static $coneccion;

abstract class DaoConnection {


/**
 * crear coneccion a la base
 * @return mysqli_connect devuelve la coneccion a la base de datos
 */
public static function connection()   {
   //  $user="id3133169_desatallermr2g";
	// $pass="desatalleringmr2g";
	// $server="localhost";
	// $db="id3133169_desatallermr2g";

     $user="id2846195_talleringmr2g";
	 $pass="talleringmr2g";
	 $server="localhost";
	 $db="id2846195_tallering";
    if (!isset(self::$coneccion)) {
        $coneccion = mysqli_connect($server, $user, $pass, $db);
         /* Desactivar la autoconsigna */
      //  $coneccion->autocommit(FALSE);
    }

	return $coneccion;

}

/**
 * Sierra la coneccion a la base de datos
 */
public static function close(){
    mysql_close($coneccion);
}
}


?>
