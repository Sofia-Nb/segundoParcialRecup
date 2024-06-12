<?php

class EmpresaCable{
    private $colPlanes;
    private $colContratos;

    public function __construct() {
        $this->colPlanes = array();
        $this->colContratos = array();
    }

    public function getColPlanes() {
        return $this->colPlanes;
    }

    public function getColContratos() {
        return $this->colContratos;
     }


    public function setColPlanes($colPlanes) {
        $this->colPlanes = $colPlanes;
    }

    public function setColContratos($colContratos) {
        $this->colContratos = $colContratos;
    }

    public function incorporarPlan($objPlan){
        $incorporar = true;
        $nuevaColCanales = $objPlan->getColCanales();
        $colPlanes = $this->getColPlanes(); 
        foreach ($colPlanes as $objetoPlan){
            $colCanales = $objetoPlan->getColCanales();
            foreach ($colCanales as $objetoCanal){
                $tipo = $objetoCanal->getTipo();
                $mg = $objetoCanal->getIncluyeMG();
                foreach ($nuevaColCanales as $nuevObjCanal){
                    $tipoNuevo = $nuevObjCanal->getTipo();
                    $mgNuevo = $nuevObjCanal->getIncluyeMG();
                    if(($tipo && $mg) == ($tipoNuevo && $mgNuevo)){
                        $incorporar = false;
                    }
                }
                }
            }
            if ($incorporar){
                array_push($colPlanes, $objPlan);
                $this->setColPlanes($colPlanes);
            }
        }
    

    public function incorporarContrato ($objPlan,$objCliente,$fechaDesde,$fechaVenc,$esViaWeb){
        $colContratos = $this->getColContratos();
        if ($esViaWeb){
            $objContrato = new ContratoViaWeb($fechaDesde, $fechaVenc, $objPlan, 0000, true, $objCliente, 10, "al dia");
        }else{
            $objContrato = new ContratoEmpresa($fechaDesde, $fechaVenc, $objPlan, 0000, true, $objCliente, "al dia");
        }
        array_push($colContratos, $objContrato);
        $this->setColContratos($colContratos);
    }

    public function retornarImporteContratos ($codigoPlan){
        $colContratos = $this->getColContratos();
        $suma = 0;
        foreach ($colContratos as $objContrato){
            $objetoPlan = $objContrato->getObjPlan();
            $codPlan = $objetoPlan->getCodigo();
            if ($codPlan == $codigoPlan){
                $importe = $objContrato->getCosto();
                $suma = $suma + $importe;
            }
        }
        return $suma;
    }

    public function pagarContrato ($objContrato){
        $importeFinal = $objContrato->calcularImporte();
        $objContrato->actualizarEstadoContrato();

        return $importeFinal;
    }

    public function mostrarColeccion($coleccion){
        $resultado = null;
        foreach ($coleccion as $objeto){
            $resultado .= $objeto."\n";
        }
        return $resultado;
    }

    public function __toString(){
        $cartel = "PLANES: \n";
        $cartel .= $this->mostrarColeccion($this->getColPlanes());
        $cartel .= "**********************************************\n";
        $cartel .= "CONTRATOS: \n";
        $cartel .= $this->mostrarColeccion($this->getColContratos());
    }
}
?>