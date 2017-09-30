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
     public function  getId(){
        return $this->id;
    }
     public function  getCalle(){
        return $this->calle;
    }
    public function  getNumero(){
        return $this->numero;
    }
    public function  getPiso(){
        return $this->piso;
    }
    public function  getDepto(){
        return $this->depto;
    }
    public function  getProvincia(){
        return $this->provincia;
    }
     public function  getCiudad(){
        return $this->ciudad;
    }
     public function  setCiudad($ciudad){
        $this->ciudad=$ciudad;
    }
     public function  setId($id){
        $this->id=$id;
    }
     public function  setCalle($calle){
        $this->calle=$calle;
    }
     public function  setNumero($numero){
        $this->numero=$numero;
    }
     public function  setPiso($piso){
        $this->piso=$piso;
    }
     public function  setDepto($depto){
        $this->depto=$depto;
    }
     public function  setProvincia($provincia){
        $this->provincia=$provincia;
    }
}

?>
