<?php
namespace model\entities;

class DomicilioEntity{
    var $id;
    var $calle;
    var $numero;
    var $piso;
    var $depto;
    var $provincia;
    var $ciudad;
function __construct($id,$calle,$numero,$piso,$depto,$provincia,$ciudad){
    $this->id=$id;
    $this->calle=$calle;
    $this->numero=$numero;
    $this->piso=$piso;
    $this->depto=$depto;
    $this->provincia=$provincia;
    $this->ciudad=$ciudad;
}

}

?>
