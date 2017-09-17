<?php

private static $coneccion;

abstract class DaoConnection {

    private $user="id2846195_talleringmr2g";
	private $pass="talleringmr2g";
	private $server="localhost";
	private $db="id2846195_tallering";
/**
 * crear coneccion a la base
 * @return mysqli_connect devuelve la coneccion a la base de datos
 */
public static connection()   {

    if (!isset(self::$coneccion)) {
        $coneccion = mysqli_connect($this->server, $this->user, $this->pass, $this->db);
    }

	return $coneccion;

}
/**
 * Sierra la coneccion a la base de datos
 */
public close(){
    mysql_close($coneccion);
}
}


?>
