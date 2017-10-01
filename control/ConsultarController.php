<?php
include '../model/ABMPadrino.php';
class ConsultarController{

    function buscarAllPadrinoLibres(){
         $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->buscarPadrinosLibres(null);
        if(count($restPadrino)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($restPadrino);
        }

    }



}

?>
