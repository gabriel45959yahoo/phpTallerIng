<?php

private static $coneccion;
class DaoConnection {

    private $user="id2846195_talleringmr2g";
	private $pass="talleringmr2g";
	private $server="localhost";
	private $db="id2846195_tallering";

public static connection()   {

    if (!isset(self::$coneccion)) {
        $coneccion = mysqli_connect($this->server, $this->user, $this->pass, $this->db);
    }

	return $coneccion;

}

public close(){
    mysql_close($coneccion);
}
}


?>
