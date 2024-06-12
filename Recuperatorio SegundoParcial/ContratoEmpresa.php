<?php

class ContratoEmpresa extends Contrato{

    public function __construct($fechaInicio, $fechaVnecimineto, $objPlan, $costo, $seRenueva, $objCliente){
        parent::__construct($fechaInicio, $fechaVnecimineto, $objPlan, $costo, $seRenueva, $objCliente);
    }

    public function calcularImporte(){
        $costo = parent::calcularImporte();
        $objPlan = parent::getObjPlan();
        $colCanales = $objPlan->getColCanales();
        $importePlan = $objPlan->getImporte();
        $suma = 0;
        foreach ($colCanales as $objCanal){
            $importe = $objCanal->getImporte();
            $suma = $suma + $importe;
        }
        $suma = $suma + $importePlan + $costo;
        return $suma;
    }
}