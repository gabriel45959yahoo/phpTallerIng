<?php
namespace model\dao;

class DatosFactEntity{

    var id;
    var nombre;
    var apellido;
    var idPomicilio;
    var idPadrino;
    var fechaAlta;
    var fechaBaja;

function __construct($id,$nombre,$apellido,$idPomicilio,$idPadrino){

    $this->id=$id;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->idDomicilio=$idPomicilio;
    $this->idPadrino=$idPadrino;
}

}
?>
